import { reactive } from 'vue';

const Notify = {
    notifications: reactive([]),
    addNotification(obj) {
        var vm = this;

        return new Promise((resolve, reject) => {
            obj.resolve = resolve;
            obj.reject = reject;
            obj._timeout_running = true;

           vm.notifications.push(obj);
        });
    },
    removeNotification(obj, result, message = null) {
        if (obj._prompt == true) {
            obj.resolve((result == true ? message : false));
        } else if (result !== null) {
            obj.resolve(result);
        }
        this.notifications.splice(this.notifications.indexOf(obj), 1);
    }
};

const Notification = class Notification {
    constructor(message) {
        this._message = message;
        this._icon = 'information-circle';
        this._color = 'accent';
        this._buttons = [];
        this._uuid = this.uuid();

        return this;
    }

    title(title) {
        this._title = title;

        return this;
    }

    icon(icon) {
        this._icon = icon;

        return this;
    }

    color(color) {
        this._color = color;

        return this;
    }

    timeout(timeout = 7500) {
        this._timeout = timeout;

        return this;
    }

    indeterminate() {
        this._indeterminate = true;

        return this;
    }

    prompt(value = '') {
        this._prompt = true;
        this._prompt_value = value;

        return this;
    }

    confirm() {
        this._confirm = true;

        return this;
    }

    addButton(button) {
        this._buttons.push(button);

        return this;
    }

    show() {
        if (this._confirm && this._buttons.length == 0) {
            this.addButton({
                key: true,
                value: 'voyager::generic.yes',
                color: 'green',
            }).addButton({
                key: false,
                value: 'voyager::generic.no',
                color: 'red',
            });
        } else if (this._prompt && this._buttons.length == 0) {
            this.addButton({
                key: true,
                value: 'voyager::generic.ok',
                color: 'green',
            }).addButton({
                key: false,
                value: 'voyager::generic.cancel',
                color: 'red',
            });
        }
        if (!this._prompt && !this._confirm) {
            Notify.addNotification(this);

            return this;
        }
        var vm = this;

        return new Promise((resolve, reject) => {
            Notify.addNotification(vm)
            .then((result, message = null) => {
                resolve(result, message);
            });
        });
    }

    uuid() {
        var dt = new Date().getTime();
        var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, (c) => {
            var r = (dt + Math.random()*16)%16 | 0;
            dt = Math.floor(dt/16);
            return (c=='x' ? r :(r&0x3|0x8)).toString(16);
        });
    
        return uuid;
    }

    remove() {

    }
};

export {
    Notify,
    Notification
};