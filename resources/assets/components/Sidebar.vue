<template key="sidebar">
    <!-- Mobile sidebar -->
    <div v-if="$store.sidebarOpen" class="md:hidden">
        <div class="fixed inset-0 z-30">
            <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
        </div>
        <div class="fixed inset-0 flex z-40" @click="$store.toggleSidebar()">
            <div class="flex-1 flex flex-col max-w-xs w-full sidebar" @click.stop="">
                <div class="absolute top-0 right-0 p-1">
                    <button @click="$store.toggleSidebar()" class="flex items-center justify-center h-12 w-12 rounded-full">
                        <icon icon="x"></icon>
                    </button>
                </div>
                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <div class="flex-shrink-0 flex items-center px-4">
                        <icon icon="helm" :size="10" class="icon"></icon>
                        <span class="font-black text-lg uppercase pl-2 title">
                            {{ $store.sidebar.title }}
                        </span>
                    </div>
                    <nav class="mt-3 px-2">
                        <menu-wrapper
                            :items="$store.sidebar.items"
                            :current-url="$store.current_url"
                            :parent-url="null"
                        />
                    </nav>
                </div>
                <div class="flex-shrink-0 flex border-t sidebar-border p-4">
                    <button class="button accent" @click="$store.toggleDarkMode()">
                        <icon :icon="$store.darkmode ? 'sun' : 'moon'"></icon>
                    </button>
                    <img :src="$store.user.avatar" class="rounded-full m-4 w-8" alt="User Avatar">
                </div>
            </div>
            <div class="flex-shrink-0 w-14"></div>
        </div>
    </div>

    <!-- Desktop sidebar -->
    <collapse-x-transition>
        <div class="hidden md:flex md:flex-shrink-0 sidebar h-full" v-if="$store.sidebarOpen" id="sidebar">
            <div class="flex flex-col w-64 border-r sidebar-border">
                <div class="h-0 flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <icon icon="helm" :size="10" class="icon"></icon>
                        <span class="font-black text-lg uppercase ltr:pl-2 rtl:pr-2 title whitespace-nowrap">
                            {{ $store.sidebar.title }}
                        </span>
                    </div>            
                    <nav class="mt-4 flex-1 px-2">
                        <menu-wrapper
                            :items="$store.sidebar.items"
                            :current-url="$store.current_url"
                        />
                    </nav>
                </div>
                <div class="flex-shrink-0 inline-flex border-t sidebar-border p-4 h-auto overflow-x-hidden">
                    <button class="button accent small" @click="$store.toggleDarkMode()">
                        <tooltip v-if="$store.darkmode == 'dark'" :value="__('voyager::generic.dark_mode_on')">
                            <icon icon="moon" />
                        </tooltip>
                        <tooltip v-else-if="$store.darkmode == 'light'" :value="__('voyager::generic.dark_mode_off')">
                            <icon icon="sun" />
                        </tooltip>
                        <tooltip v-else :value="__('voyager::generic.dark_mode_system')">
                            <icon icon="desktop-computer" />
                        </tooltip>
                    </button>
                    <button class="button accent small" v-scroll-to="''">
                        <icon icon="arrow-up" />
                    </button>
                    <button class="button accent small" @click="$store.toggleDirection()">
                        <icon icon="switch-horizontal" />
                    </button>
                </div>
            </div>
        </div>
    </collapse-x-transition>
</template>

<script>
import scrollTo from '../js/directives/scroll-to';
import Tooltip from './UI/Tooltip.vue';

export default {
    components: { Tooltip },
    directives: { scrollTo: scrollTo }
}
</script>

<style lang="scss">
@import "../sass/mixins/bg-color";
@import "../sass/mixins/border-color";
@import "../sass/mixins/text-color";

.dark .sidebar {
    @include bg-color(sidebar-bg-color-dark, 'colors.gray.800');

    .title {
        @include text-color(sidebar-title-color-dark, 'colors.gray.200');
    }
    .icon {
        @include text-color(sidebar-icon-color-dark, 'colors.gray.200');
    }

    .menuitem {
        .item {
            .link {
                @include text-color(sidebar-item-text-color-dark, 'colors.gray.300');
            }

            &:hover {
                @include bg-color(sidebar-item-hover-color-dark, 'colors.gray.700');
            }

            &.active {
                @include bg-color(sidebar-item-active-color-dark, 'colors.gray.850');

                .link {
                    @include text-color(sidebar-item-text-active-color-dark, 'colors.gray.200');
                }

                .icon {
                    @include text-color(sidebar-item-icon-active-color-dark, 'colors.gray.200');
                }
            }

            .icon {
                @include text-color(sidebar-item-icon-color-dark, 'colors.gray.300');
            }
        }
    }

    .sidebar-border {
        @include border-color(sidebar-border-color-dark, 'colors.gray.700');
    }
}

.sidebar {
    @include bg-color(sidebar-bg-color, 'colors.gray.800');

    .title {
        @include text-color(sidebar-title-color, 'colors.gray.200');
    }
    .icon {
        @include text-color(sidebar-icon-color, 'colors.gray.200');
    }

    .menuitem {
        .item {
            .link {
                @include text-color(sidebar-item-text-color, 'colors.gray.300');
            }

            &:hover {
                @include bg-color(sidebar-item-hover-color, 'colors.gray.600');
            }

            &.active {
                @include bg-color(sidebar-item-active-color, 'colors.gray.700');

                .link {
                    @include text-color(sidebar-item-text-active-color, 'colors.gray.300');
                }

                .icon {
                    @include text-color(sidebar-item-icon-active-color, 'colors.gray.300');
                }
            }

            .icon {
                @include text-color(sidebar-item-icon-color, 'colors.gray.300');
            }
        }
    }

    .sidebar-border {
        @include border-color(sidebar-border-color, 'colors.gray.600');
    }
}
</style>