<template>

    <div>
        <a class="button is-info" v-on:click="fetch">Refresh</a>
        <div v-for="server in servers">
            <server :server="{id: server.id, name: server.name, url: server.server_url, status: server.status,}"></server>

        </div>

    </div>

</template>

<script>
    export default {

        data() {
           return  {
             servers: []
           };
        },
        created() {
            this.fetch();
        },
        methods: {

            fetch() {
                this.servers = [];
                axios.get('/api/server/all').then(response => {

                    var responseData = response.data;
                    var data = [];

                    responseData.forEach(function (server){
                        data.push({
                            id: server.id,
                            name: server.name,
                            server_url: server.server_url,
                            status: server.server_url,
                        });
                    });

                    this.update(data);

                });
            },

            update(data) {

                for (var i = 0; i < data.length; i++) {
                    this.ping(data[i]);
                }
            },

            ping(server) {
                var serverId   = server.id;
                var serverName   = server.name;
                var serverUrl    = server.server_url;
                var serverStatus = null;

                axios.post('/api/server/ping', {
                    serverUrl: serverUrl,
                })
                .then(response => {
                    console.log(server);
                    serverStatus = response.data.status;
                    this.servers.push({
                        id: serverId,
                        name: serverName,
                        server_url: serverUrl,
                        status: serverStatus,
                    });
                    serverId = null;
                    serverName = null;
                    serverUrl = null;
                    serverStatus = null;
                })
                .catch(function (error) {
                    return error;
                });
            }
        },

    };
</script>
