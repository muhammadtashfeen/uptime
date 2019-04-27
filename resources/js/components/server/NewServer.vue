<template>

    <div class="box mt-20">

        <a v-if="!addNewServer"
           v-on:click="addNewServer = 1"
           class="button is-primary">Add New Server</a>

        <div v-if="addNewServer" class="mx-auto">
            <form>
                <div class="field">
                    <label class="label">Server name</label>
                    <div class="control">
                        <input v-model="serverName" class="input" type="text" placeholder="Wordpress">
                    </div>
                    <p class="help">Any name to identify the server.</p>
                </div>

                <div class="field">
                    <label class="label">Server Address</label>
                    <div class="control">
                        <input v-model="serverUrl" class="input" type="text" placeholder="http://myserver.com">
                    </div>
                </div>
                <p class="help has-text-danger">{{ this.errorMessage }}</p>
                <div class="control">
                    <a class="button is-primary"
                       v-on:click="create()">
                        Add
                    </a>
                    <a class="button"
                       v-on:click="addNewServer = 0">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

    </div>


</template>

<script>
    export default {
        data() {
            return {
                addNewServer: false,
                serverUrl: '',
                serverName: '',
                errorMessage: ''
            };
        },
        methods: {
            create() {

                if(!this.validate()) {
                    return;
                }

                axios.post('/api/server/new', {
                    name: this.serverName,
                    server_url: this.serverUrl,
                })
                .then(response => {
                    this.$emit('serverAdded');
                    this.addNewServer = false;
                })
                .catch(error => {
                    console.log(error);
                });
            },
            validate() {
                if (!this.serverName || !this.serverUrl) {
                    this.errorMessage = 'Please fill in all fields.';
                    return false;
                }
                this.errorMessage = '';
                return true;
            }
        },
    };
</script>
