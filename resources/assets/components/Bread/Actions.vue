<template>
    <div v-for="(action, i) in filteredActions" :key="i">
        <component
            :is="action.method == 'get' ? 'a' : 'button'"
            class="button small"
            :class="action.color"
            :href="getUrl(action)"
            @click="click(action, $event)"
            v-show="amount(action) > 0"
        >
            <icon v-if="action.icon !== null" :icon="action.icon" :size="4" />
            <span>{{ trans_choice(action.title, amount(action), replace) }}</span>
        </component>
    </div>
</template>

<script>
import wretch from '../../js/wretch';

export default {
    emits: ['reload'],
    props: {
        bulk: {
            type: Boolean,
            default: false,
        },
        actions: {
            type: Array,
            required: true,
        },
        bread: {
            type: Object,
            required: true,
        },
        selected: {
            type: Array,
            required: true,
        },
    },
    computed: {
        filteredActions() {
            return this.actions.where('bulk', this.bulk);
        },
        replace() {
            return {
                type: this.translate(this.bread.name_singular, true),
                types: this.translate(this.bread.name_plural, true)
            };
        },
        deletable() {
            return this.selected.where('is_soft_deleted', false).length;
        },
        restorable() {
            return this.selected.where('is_soft_deleted', true).length;
        }
    },
    methods: {
        getUrl(action) {
            if (action.method !== 'get') {
                return;
            } else if (this.selected.length == 1) {
                return this.route(action.route_name, this.selected[0].primary_key);
            } else if (action.display_deletable === null) {
                return this.route(action.route_name);
            }

            return '#';
        },
        click(action, e) {
            if (action.method !== 'get') {
                e.preventDefault();
                e.stopPropagation();

                if (this.isObject(action.confirm)) {
                    new this.$notification(this.trans_choice(action.confirm.message || null, this.amount(action), this.replace))
                        .title(this.trans_choice(action.confirm.title || null, this.amount(action), this.replace))
                        .color(action.confirm.color)
                        .confirm()
                        .timeout()
                        .show()
                        .then((response) => {
                            if (response === true) {
                                this.executeAction(action);
                            }
                        });
                } else {
                    this.executeAction(action);
                }
            }
        },
        executeAction(action) {
            let req = wretch(this.route(action.route_name));
            let args = {
                primary: this.selectedPrimarys(action)
            };

            switch (action.method.toLowerCase()) {
                case 'get':
                    req = req.get(args);
                    break;
                case 'put':
                    req = req.put(args);
                    break;
                case 'patch':
                    req = req.patch(args);
                    break;
                case 'delete':
                    req = req.delete(args);
                    break;
                default:
                    req = req.post(args);
                    break;
            }

            action.download === true ? 'blob' : 'json'

            if (action.download === true) {
                req = req.blob((response) => {
                    const url = window.URL.createObjectURL(new Blob([response]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', action.file_name);
                    link.click();
                    window.URL.revokeObjectURL(url);
                });
            } else {
                req = req.json((response) => {
                    if (this.isObject(action.success)) {
                    var amount = response.amount || 1;
                    var replace = response;
                    replace.type = this.translate(this.bread.name_singular, true);
                    replace.types = this.translate(this.bread.name_plural, true);

                    new this.$notification(this.trans_choice(action.success.message || null, amount, replace))
                        .title(this.trans_choice(action.success.title || null, amount, replace))
                        .color(action.success.color)
                        .timeout()
                        .show();
                }
                });
            }

            req.then(() => {
                if (action.reload_after) {
                    this.$emit('reload');
                }
            })
            .catch((response) => {
                console.log(response);
                this.$store.handleAjaxError(response);
            });
        },
        selectedPrimarys(action) {
            if (action.bulk) {
                return this.selected.pluck('primary_key');
            }

            return this.selected[0].primary_key;
        },
        amount(action) {
            if (action.display_deletable === true) {
                return action.bulk ? this.deletable : (this.selected[0].is_soft_deleted ? 0 : 1);
            } else if (action.display_deletable === false) {
                return action.bulk ? this.restorable : (this.selected[0].is_soft_deleted ? 1 : 0);
            } else if (action.display_deletable === null) {
                return 1;
            }

            return this.selected.length;
        }
    }
}
</script>