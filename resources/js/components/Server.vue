<template>
    <div class="box mt-20">

        <div class="columns" v-if="!shouldEdit" v-on:click="shouldEdit = true">
            <p class="column">{{ server.name }}</p>
            <p class="column">{{ server.url }}</p>
            <p class="column">
                    <span class="tag is-primary">
                        {{ server.status }}
                    </span>
            </p>
        </div>

        <form v-if="shouldEdit">
            <div class="columns">
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
                       v-on:click="update(server.name, server.url)">Update</a>
                    <a class="button is-default"
                       v-on:click="shouldEdit = false">Cancel</a>
                </div>

            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                shouldEdit: false
            };
        },
        methods: {
          update(url) {
              console.log(url);
          }
        },
        props: {
            server: Object,
        }
    };
</script>
