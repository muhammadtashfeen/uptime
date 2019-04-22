<template>
    <div class="box mt-20">

        <div class="columns" v-if="!shouldEdit" v-on:click="shouldEdit = true">
            <p class="column">{{ server.name }}</p>
            <p class="column">{{ server.url }}</p>
            <p class="column">
                    <span class="tag is-primary"
                          v-bind:class="{'is-danger': (server.status == 'down')}">
                        {{ server.status }}
                    </span>
            </p>
        </div>

        <form v-if="shouldEdit">

                <div class="column">
                    <input class="input"
                           type="hidden"
                           v-model="server.id"
                           placeholder="Wordpress">
                </div>
                <div class="column">
                    <input class="input"
                           type="text"
                           v-model="server.name"
                           placeholder="Wordpress">
                </div>
                <div class="column">
                    <input class="input"
                           type="text"
                           v-model="server.url"
                           placeholder="Wordpress">
                </div>
                <p class="help has-text-danger">{{ this.errorMessage }}</p>
                <div class="column">
                    <a class="button is-primary"
                       v-on:click="update(server.id, server.name, server.url)">Update</a>
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
                       v-on:click="deleteServer(server.id)"
                       :disabled="deleteConfirmationText != server.name">Delete</a>
                </div>


        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                shouldEdit: false,
                errorMessage: '',
                deleteConfirmationText: '',
            };
        },
        methods: {
         
          update(id, name, url) {
              
              if(!this.validate(name, url)) {
                return;
              }

              axios.post('/api/server/update', {
                  id: id,
                  name: name,
                  server_url: url,
              }).then(response => {
                  this.$emit('serverUpdated');
              }).catch(error => {
                  alert(error);
              });

          },
          
          deleteServer(id) {

              axios.post('/api/server/delete', {
                  id: id,
              }).then(response => {
                  this.$emit('serverDeleted');
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

          }


        },
        props: {
            server: Object,
        }
    };
</script>
