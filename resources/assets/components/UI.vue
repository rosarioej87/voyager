<template>
    <card title="UI Elements">
        <div>
            <div class="inline w-full">
            <button class="button accent my-2" v-scroll-to="'ui-headings'">
                    Headings
                </button>
                <button class="button accent my-2" v-scroll-to="'ui-icons'">
                    Icons
                </button>
                <button class="button accent my-2" v-scroll-to="'ui-buttons'">
                    Buttons
                </button>
                <button class="button accent my-2" v-scroll-to="'ui-inputs'">
                    Inputs
                </button>
                <button class="button accent my-2" v-scroll-to="'ui-color-picker'">
                    Color picker
                </button>
                <button class="button accent my-2" v-scroll-to="'ui-tags'">
                    Tag input
                </button>
                <button class="button accent my-2" v-scroll-to="'ui-tabs'">
                    Tabs
                </button>
                <button class="button accent my-2" v-scroll-to="'ui-badges'">
                    Badges
                </button>
                <button class="button accent my-2" v-scroll-to="'ui-alerts'">
                    Alerts
                </button>
                <button class="button accent my-2" v-scroll-to="'ui-tooltips'">
                    Tooltips
                </button>
                <button class="button accent my-2" v-scroll-to="'ui-notifications'">
                    Notifications
                </button>
                <button class="button accent my-2" v-scroll-to="'ui-pagination'">
                    Pagination
                </button>
            </div>
        </div>
    </card>

    <card dont-show-header>
        <div class="w-full flex">
            <div class="w-6/12">
                <collapsible title="Headings" id="ui-headings" class="h-full">
                    <h1>H1 Heading</h1>
                    <h2>H2 Heading</h2>
                    <h3>H3 Heading</h3>
                    <h4>H4 Heading</h4>
                    <h5>H5 Heading</h5>
                    <h6>H6 Heading</h6>
                </collapsible>
            </div>
            <div class="w-6/12">
                <collapsible title="Icons" id="ui-icons" class="h-full">
                    <icon-picker />
                </collapsible>
            </div>
        </div>
    </card>

    <collapsible title="Buttons" id="ui-buttons">
        <div class="w-full flex">
            <div class="w-4/12">
                <collapsible title="Default" :title-size="5">
                    <div class="flex flex-wrap justify-center">
                        <button class="button mb-1">
                            Default
                        </button>
                        <button v-for="color in colors" :key="'button-'+color" :class="['button', color, 'mb-1']">
                            {{ __('voyager::generic.color_names.'+color) }}
                        </button>
                    </div>
                </collapsible>
            </div>
            <div class="w-4/12">
                <collapsible title="Active" :title-size="5">
                    <div class="flex flex-wrap justify-center">
                        <button class="button active mb-1">
                            Default
                        </button>
                        <button v-for="color in colors" :key="'button-'+color" :class="['button', color, 'mb-1', 'active']">
                            {{ __('voyager::generic.color_names.'+color) }}
                        </button>
                    </div>
                </collapsible>
            </div>
            <div class="w-4/12">
                <collapsible title="Disabled" :title-size="5">
                    <div class="flex flex-wrap justify-center">
                        <button class="button mb-1" disabled>
                            Default
                        </button>
                        <button v-for="color in colors" :key="'button-'+color" :class="['button', color, 'mb-1']" disabled>
                            {{ __('voyager::generic.color_names.'+color) }}
                        </button>
                    </div>
                </collapsible>
            </div>
        </div>
        <div class="w-full flex">
            <div class="w-4/12">
                <collapsible title="With Icon" :title-size="5">
                    <div class="flex flex-wrap justify-center">
                        <button class="button small mb-1">
                            <icon icon="information-circle" class="mr-1" :size="4"></icon>
                            Default
                        </button>
                        <button v-for="color in colors" :key="'button-'+color" :class="['button', 'small', color, 'mb-1']">
                            <icon icon="information-circle" class="mr-1" :size="4"></icon>
                            {{ __('voyager::generic.color_names.'+color) }}
                        </button>
                    </div>
                </collapsible>
            </div>
            <div class="w-4/12">
                <collapsible title="Responsive" :title-size="5">
                    <div class="flex flex-wrap justify-center">
                        <button :class="['button', 'small', 'mb-1']">
                            <icon icon="information-circle" :size="4"></icon>
                            <span>Default</span>
                        </button>
                        <button v-for="color in colors" :key="'button-'+color" :class="['button', 'small', color, 'mb-1']">
                            <icon icon="information-circle" :size="4"></icon>
                            <span>{{ __('voyager::generic.color_names.'+color) }}</span>
                        </button>
                    </div>
                </collapsible>
            </div>
            <div class="w-4/12">
                <collapsible title="Button group" :title-size="5">
                    <div class="flex flex-wrap justify-center">
                        <div class="button-group">
                            <button v-for="color in colors" :key="'button-'+color" :class="['button', color, 'mb-1']">
                                {{ __('voyager::generic.color_names.'+color) }}
                            </button>
                        </div>
                    </div>
                </collapsible>
            </div>
        </div>
    </collapsible>

    <collapsible title="Inputs" id="ui-inputs">
        <div class="flex w-full">
            <collapsible title="Default" :title-size="5" class="w-1/3">
                <input type="text" class="input w-full" placeholder="Placeholder" />
            </collapsible>
            <collapsible title="Disabled" :title-size="5" class="w-1/3">
                    <input type="text" class="input w-full" disabled placeholder="Placeholder" />
            </collapsible>
            <collapsible title="Small" :title-size="5" class="w-1/3">
                <input type="text" class="input w-full small" placeholder="Placeholder" />
            </collapsible>
        </div>
    </collapsible>

    <collapsible title="Color picker" id="ui-color-picker">
        <collapsible title="Colors" id="ui-color-picker">
            <color-picker :describe="true"></color-picker>
        </collapsible>
    </collapsible>

    <collapsible title="Tag input" id="ui-tags">
        <tag-input v-model="tags"></tag-input>
    </collapsible>

    <collapsible title="Tabs" id="ui-tabs">
        <tabs :tabs="[{name: 'tab1', title: 'Tab 1'}, {name: 'tab2', title: 'Tab 2'}, {name: 'tab3', title: 'Tab 3'}]">
            <template #tab1>
                <h3>Tab 1</h3>
                <p>{{ lorem }}</p>
            </template>
            <template #tab2>
                <h3>Tab 2</h3>
                <p>{{ lorem }}</p>
            </template>
            <template #tab3>
                <h3>Tab 3</h3>
                <p>{{ lorem }}</p>
            </template>
        </tabs>
    </collapsible>

    <collapsible title="Badges" id="ui-badges">
        <div class="w-full flex">
            <collapsible title="Default" :title-size="5" class="w-1/4">
                <badge v-for="color in colors" :color="color" :key="'badge-'+color">
                    {{ __('voyager::generic.color_names.'+color) }}
                </badge>
            </collapsible>
            <collapsible title="Large" :title-size="5" class="w-1/4">
                <badge v-for="color in colors" :color="color" :key="'badge-'+color" large>
                    {{ __('voyager::generic.color_names.'+color) }}
                </badge>
            </collapsible>
            <collapsible title="With icon" :title-size="5" class="w-1/4">
                <badge v-for="color in colors" :color="color" :key="'badge-'+color" icon="x">
                    {{ __('voyager::generic.color_names.'+color) }}
                </badge>
            </collapsible>
            <collapsible title="Large with icon" :title-size="5" class="w-1/4">
                <badge v-for="color in colors" :color="color" :key="'badge-'+color" icon="information-circle" large>
                    {{ __('voyager::generic.color_names.'+color) }}
                </badge>
            </collapsible>
        </div>
    </collapsible>

    <collapsible title="Alerts" id="ui-alerts">
        <alert v-for="color in colors" :color="color" :key="'alert-'+color" class="mb-3">
            <template #title>{{ __('voyager::generic.color_names.'+color) }}</template>
            <p>{{ lorem }}</p>
        </alert>
    </collapsible>

    <collapsible title="Tooltips" id="ui-tooltips">
        <div class="w-full flex justify-center">
            <tooltip value="Tooltip on top" placement="top">
                <button class="button">Top</button>
            </tooltip>
        </div>
        <div class="w-full inline-flex justify-center my-2">
            <tooltip value="Tooltip on the left" placement="left">
                <button class="button">Left</button>
            </tooltip>
            <tooltip value="Tooltip on the right" placement="right">
                <button class="button">Right</button>
            </tooltip>
        </div>
        <div class="w-full flex justify-center">
            <tooltip value="Tooltip on the bottom">
                <button class="button">Bottom</button>
            </tooltip>
        </div>
    </collapsible>

    <collapsible title="Notifications" id="ui-notifications">
        <collapsible v-for="color in colors" :key="'notification_'+color" :title="__('voyager::generic.color_names.'+color)" :title-size="5">
            <div class="inline-flex flex-wrap">
                <button @click="new $notification(lorem).title(ucFirst(color)).color(color).show()" class="button mb-1" :class="color">Message and title</button>
                <button @click="new $notification(lorem).color(color).show()" class="button mb-1" :class="color">Message only</button>
                <button @click="new $notification(lorem).title(ucFirst(color)).color(color).indeterminate().show()" class="button mb-1" :class="color">Indeterminate</button>
                <button @click="new $notification(lorem).title(ucFirst(color)).color(color).timeout().show()" class="button mb-1" :class="color">With timeout</button>
            </div>
        </collapsible>
        <collapsible title="Confirm" :title-size="5">
            <div class="inline-flex flex-wrap">
                <button @click="new $notification('Are you sure?').confirm().show().then((r) => {})" class="button blue mb-1">Simple</button>
                <button @click="new $notification('Are you sure?').confirm().indeterminate().show()" class="button blue mb-1">Indeterminate</button>
                <button @click="new $notification('Are you sure?').confirm().timeout().show()" class="button blue mb-1">With timeout</button>
                <button @click="new $notification('Are you sure?').confirm().addButton({key: true, value: 'Yup', color: 'green'}).addButton({key: false, value: 'Nah', color: 'red'}).show()" class="button blue mb-1">Custom buttons</button>
            </div>
        </collapsible>
        <collapsible title="Prompt" :title-size="5">
            <div class="inline-flex flex-wrap">
                <button @click="new $notification('Enter your name').prompt('').show()" class="button blue mb-1">Simple</button>
                <button @click="new $notification('Enter your name').prompt('').timeout().show()" class="button blue mb-1">With timeout</button>
                <button @click="new $notification('Enter your name').prompt('').addButton({key: true, value: 'Safe', color: 'green'}).addButton({key: false, value: 'Abort', color: 'red'}).show()" class="button blue mb-1">Custom buttons</button>
                <button @click="new $notification('Enter your name').prompt(name).show().then((r) => { if (r !== false) { name = r; } })" class="button blue mb-1">Value: {{ name }}</button>
            </div>
        </collapsible>
    </collapsible>

    <collapsible title="Pagination" id="ui-pagination">
        <collapsible title="Default" :title-size="5">
            <pagination :page-count="100" :value="1"></pagination>
        </collapsible>

        <collapsible title="No previous/next button" :title-size="5">
            <pagination :page-count="100" :value="10" :prev-next-buttons="false"></pagination>
        </collapsible>
        
        <collapsible title="No first/last button" :title-size="5">
            <pagination :page-count="100" :value="25" :first-last-buttons="false"></pagination>
        </collapsible>

        <collapsible title="Only page-buttons" :title-size="5">
            <pagination :page-count="100" :value="50" :first-last-buttons="false" :prev-next-buttons="false"></pagination>
        </collapsible>

        <collapsible title="Different color (Works with all other colors as well)" :title-size="5">
            <pagination :page-count="100" :value="100" color="red"></pagination>
        </collapsible>
    </collapsible>
</template>
<script>
import scrollTo from '../js/directives/scroll-to';

export default {
    directives: {scrollTo: scrollTo},
    data() {
        return {
            name: 'Voyager',
            lorem: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid pariatur, ipsum similique veniam quo totam eius aperiam dolorum.',
            tags: ['Lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipisicing', 'elit'],
        };
    }
}
</script>