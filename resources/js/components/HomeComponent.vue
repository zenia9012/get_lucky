<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Manage Links</div>

                    <div class="card-body">
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item">
                                <button @click="copyLink" class="btn btn-success">Copy link</button>
                            </li>
                            <li class="list-group-item">
                                <input type="text" readonly ref="copy" :value="authLink()">
                            </li>
                        </ul>
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item">
                                <button @click="generateLink" class="btn btn-success">Generate new link</button>
                            </li>
                            <li class="list-group-item">
                                <button @click="destroyLink" class="btn btn-success">Destroy link</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Get lucky</div>

                    <div class="card-body">
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item">
                                <button @click="getLucky" class="btn btn-success">Im feeling lucky</button>
                            </li>
                            <li class="list-group-item">
                                <input type="number" v-model="play.number" readonly disabled>
                            </li>
                            <li class="list-group-item">
                                <p>
                                    {{ playMessage}}
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">History</div>

                    <div class="card-body">
                        <div><button @click="showHistory" class="btn btn-success mb-2">Get History</button></div>
                        <table class="table">
                            <tbody>
                            <tr v-for="play in plays">
                                <th scope="row">{{ play.number}}</th>
                                <td>{{ play.is_win ? 'Win' : 'Lose' }}</td>
                                <td>{{ play.price}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: ['user'],
        data() {
            return {
                user: this.user,
                play: {},
                playMessage: '',
                plays: [],
            }
        },
        methods:{
            authLink() {
                let url = window.location.origin;
                return url + '?auth_link=' + this.user.auth_link
            },
            copyLink() {
                let url = window.location.origin;
                url = url + '?auth_link=' + this.user.auth_link
                navigator.clipboard.writeText(url);
            },
            generateLink(){
                let data = {
                    auth_link: this.user.auth_link
                }
                axios.put('/users/generate-link', data)
                    .then(response => {
                        this.user.auth_link = response.data.auth_link;
                        this.copyLink();
                        alert('Link generated and copied to clipboard');
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },
            destroyLink(){
                let data = {
                    auth_link: this.user.auth_link
                }
                axios.put('/users/destroy-link', data)
                    .then(response => {
                        this.user.auth_link = response.data.auth_link;
                        this.copyLink();
                        alert('Link destroyed');
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },
            getLucky(){
                let data = {
                    auth_link: this.user.auth_link
                }
                axios.post('/plays', data)
                    .then(response => {
                        this.play = response.data;
                        let isWin = this.play.is_win ? 'Win' : 'Lose';
                        this.playMessage = 'You result is ' + isWin + ' and you won ' + this.play.price;
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },
            showHistory(){
                let data = {
                    auth_link: this.user.auth_link
                }
                axios.get('/plays?auth_link=' + this.user.auth_link)
                    .then(response => {
                        this.plays = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            }

        }
    }
</script>
