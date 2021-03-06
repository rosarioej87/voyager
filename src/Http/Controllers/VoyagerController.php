<?php

namespace Voyager\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Voyager\Admin\Facades\Voyager as VoyagerFacade;
use Voyager\Admin\Manager\Breads as BreadManager;
use Voyager\Admin\Manager\Plugins as PluginManager;
use Voyager\Admin\Traits\Bread\Browsable;

class VoyagerController extends Controller
{
    use Browsable;

    protected $breadmanager;
    protected $pluginmanager;

    public function __construct(BreadManager $breadmanager, PluginManager $pluginmanager)
    {
        $this->breadmanager = $breadmanager;
        $this->pluginmanager = $pluginmanager;
        parent::__construct($pluginmanager);
    }

    private $mime_extensions = [
        'js'    => 'text/javascript',
        'css'   => 'text/css',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
    ];

    public function assets(Request $request)
    {
        if (Str::startsWith($request->path, 'plugin/')) {
            $name = Str::after($request->path, 'plugin/');
            $asset = $this->pluginmanager->getAssets()->where('name', $name)->first();

            if ($asset) {
                $extension = Str::afterLast($name, '.');
                $mime = $this->mime_extensions[$extension];

                return $this->returnAsset($asset['content'], $mime);
            }

            return abort(404);
        }

        $path = str_replace('/', DIRECTORY_SEPARATOR, Str::start(urldecode($request->path), '/'));
        $path = realpath(dirname(__DIR__, 3).'/resources/assets/dist').$path;

        if (realpath($path) === $path && File::exists($path)) {
            $extension = Str::afterLast($path, '.');
            $mime = $this->mime_extensions[$extension] ?? File::mimeType($path);

            return $this->returnAsset(File::get($path), $mime);
        }

        abort(404);
    }

    private function returnAsset($content, $mime)
    {
        $response = response($content, 200, ['Content-Type' => $mime]);
        $response->setSharedMaxAge(31536000);
        $response->setMaxAge(31536000);
        $response->setExpires(new \DateTime('+1 year'));

        return $response;
    }

    public function dashboard()
    {
        return view('voyager::app', [
            'component'     => 'dashboard',
            'title'         => __('voyager::generic.dashboard'),
            'parameters'    => [
                'widgets'   => VoyagerFacade::getWidgets(),
            ]
        ]);
    }

    // Search all BREADS
    public function globalSearch(Request $request)
    {
        $q = $request->get('query');
        $results = collect([]);

        $this->breadmanager->getBreads()->each(function ($bread) use ($q, &$results) {
            if (!empty($bread->global_search_field)) {
                $layout = $this->getLayoutForAction($bread, 'browse');
                if ($layout) {
                    $query = $bread->getModel()->select();
                    // TODO: This can be removed when the global search allows querying relationships
                    if ($layout->searchableFormfields()->where('column.type', 'column')->count() == 0) {
                        return;
                    }
                    $query = $this->globalSearchQuery($q, $layout, VoyagerFacade::getLocale(), $query);
                    $count = $query->count();
                    $bread_results = $query->take(3)->get();
                    if (count($bread_results) > 0) {
                        $results[$bread->table] = [
                            'count'     => $count,
                            'results'   => $bread_results->mapWithKeys(function ($result) use ($bread) {
                                return [$result->getKey() => $result->{$bread->global_search_field}];
                            }),
                        ];
                    }
                }
            }
        });

        return $results;
    }

    public function getDisks(Request $request)
    {
        $disks = collect(array_keys(config('filesystems.disks', [])))->mapWithKeys(function ($disk) {
            return [$disk => $disk];
        })->toArray();

        return response()->json([$disks]);
    }

    public function getThumbnailOptions(Request $request)
    {
        extract($request->all());

        $options = [
            'method' => [
                'fit'    => __('voyager::media.thumbnails.fit'),
                'crop'   => __('voyager::media.thumbnails.crop'),
                'resize' => __('voyager::media.thumbnails.resize'),
                'label'  => __('voyager::media.thumbnails.label'),
            ]
        ];

        if (!empty($method)) {
            if ($method == 'fit') {
                $options['width'] = [
                    'type'  => 'number',
                    'label' => __('voyager::media.thumbnails.width'),
                ];
                $options['height'] = [
                    'type'  => 'number',
                    'label' => __('voyager::media.thumbnails.height_optional'),
                ];
                $options['position'] = [
                    'top-left'      => __('voyager::media.thumbnails.pos.top_left'),
                    'top'           => __('voyager::media.thumbnails.pos.top'),
                    'top-right'     => __('voyager::media.thumbnails.pos.top_right'),
                    'left'          => __('voyager::media.thumbnails.pos.left'),
                    'center'        => __('voyager::media.thumbnails.pos.center'),
                    'right'         => __('voyager::media.thumbnails.pos.right'),
                    'bottom-left'   => __('voyager::media.thumbnails.pos.bottom_left'),
                    'bottom'        => __('voyager::media.thumbnails.pos.bottom'),
                    'bottom-right'  => __('voyager::media.thumbnails.pos.bottom_right'),
                    'label'         => __('voyager::media.thumbnails.position'),
                ];
                $options['upsize'] = [
                    'type'  => 'checkbox',
                    'label' => __('voyager::media.thumbnails.upsize'),
                ];
            } elseif ($method == 'crop') {
                $options['width'] = [
                    'type'  => 'number',
                    'label' => __('voyager::media.thumbnails.width'),
                ];
                $options['height'] = [
                    'type'  => 'number',
                    'label' => __('voyager::media.thumbnails.height'),
                ];
                $options['x'] = [
                    'type'  => 'number',
                    'label' => __('voyager::media.thumbnails.x_optional'),
                ];
                $options['y'] = [
                    'type'  => 'number',
                    'label' => __('voyager::media.thumbnails.y_optional'),
                ];
            } elseif ($method == 'resize') {
                $options['width'] = [
                    'type'  => 'number',
                    'label' => __('voyager::media.thumbnails.width'),
                ];
                $options['height'] = [
                    'type'  => 'number',
                    'label' => __('voyager::media.thumbnails.height'),
                ];
                $options['keep_aspect_ratio'] = [
                    'type'  => 'checkbox',
                    'label' => __('voyager::media.thumbnails.keep_aspect_ratio'),
                ];
                $options['upsize'] = [
                    'type'  => 'checkbox',
                    'label' => __('voyager::media.thumbnails.upsize'),
                ];
            }
        }

        return response()->json($options);
    }
}
