<template>
    <div class="box mt-20">
        <form>
            <p class="title has-text-centered">{{ name }}</p>
            <div class="column">
                <input class="input"
                       type="hidden"
                       v-model="id"
                       placeholder="Wordpress">
            </div>
            <div class="column">
                <input class="input"
                       type="text"
                       v-model="name"
                       placeholder="Wordpress">
            </div>
            <div class="column">
                <input class="input"
                       type="text"
                       v-model="url"
                       placeholder="Wordpress">
            </div>
            <p class="help has-text-danger">{{ errorMessage }}</p>
            <div class="column">
                <a class="button is-primary"
                   v-on:click="update(id, name, url)">Update</a>
                <a class="button is-default"
                   v-on:click="shouldEdit = false">Cancel</a>
            </div>
            <div class="column">
                <input class="input"
                       type="text"
                       v-model="deleteConfirmationText"
                       placeholder="Server name">
                <p class="help">Type in server name to delete permanently.</p>
                <a class="button is-danger"
                   v-on:click="deleteServer(id)"
                   :disabled="this.deleteConfirmationText != this.name">Delete</a>
            </div>


        </form>
    </div>
</template>

<script>
    export default {
        data(){
          return {
              id: '',
              name: '',
              url: '',
              errorMessage: '',
              deleteConfirmationText: '',
          };
        },
        created() {
            this.eventHub.$on('showServerDetails', serverId => {
                this.fetch(serverId);
            });
        },
        methods: {
            fetch(id) {
                axios.get('/api/server/find/' + id).then(response => {

                    var response = response.data;

                    this.id = response.id;
                    this.name = response.name;
                    this.url = response.server_url;
                });
            },
            update(id, name, url) {
                if(!this.validate(name, url)) {
                    return;
                }

                axios.post('/api/server/update', {
                    id: id,
                    name: name,
                    server_url: url,
                }).then(response => {
                    this.eventHub.$emit('serverUpdated');
                }).catch(error => {
                    alert(error);
                });

            },

            deleteServer(id) {

                axios.post('/api/server/delete', {
                    id: id,
                }).then(response => {
                    this.eventHub.$emit('serverUpdated');
                }).catch(error => {
                    alert(error);
                });

            },

            validate(name, url) {

                if (!name || !url) {
                    this.errorMessage = 'Please fill in all fields';
                    return false;
                }

                this.errorMessage = '';
                return true;

            },
        }
    };
</script>
