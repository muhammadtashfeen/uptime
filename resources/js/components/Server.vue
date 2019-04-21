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
                           type="text"
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
                deleteConfirmationText: '',
            };
        },
        methods: {
          update(id, name, url) {
              console.log(url);
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
          }
        },
        props: {
            server: Object,
        }
    };
</script>
