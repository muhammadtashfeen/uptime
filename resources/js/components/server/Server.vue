<template>
    <div class="box mt-20" :class="isSelected ? 'has-background-grey-lighter' : ''">

        <div class="columns is-mobile"
             v-on:click="goToDetails(server.id)">
            <p class="column is-4">{{ server.name }}</p>
            <p class="column is-6">{{ server.url }}</p>
            <p class="column is-2">
                    <span class="tag is-primary"
                          v-bind:class="{'is-danger': (server.status == 'down')}">
                        {{ server.status }}
                    </span>
            </p>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                isSelected: false,
            };
        },

        created() {
            //Open details if index==0
            //Only when page loads the details
            if(this.$props.server.index == 0) {
                this.goToDetails(this.$props.server.id);
            }
            this.registerListener();
        },

        methods: {

          goToDetails(id) {
              this.eventHub.$emit('newServerSelected', id);
              this.eventHub.$emit('showServerDetails', id);
              this.isSelected = true;
          },

          registerListener() {
              this.eventHub.$on('newServerSelected', serverId => {
                  if(this.id == serverId) {
                      this.isSelected = true;
                      return;
                  }
                  this.isSelected = false;
              });
          }

        },
        props: {
            server: Object,
        }
    };
</script>
