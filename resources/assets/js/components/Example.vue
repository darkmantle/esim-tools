<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Ratio</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="task in list">
                        <td v-for="item in task">
                            {{item}}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                message: '',
                list: []
            }
        },
        mounted() {
            console.log("HUR")
            this.fetchTaskList();
        },
        methods: {
            fetchTaskList: function () {
                this.$http.get('/api/exchange').then(function (response) {
                    console.log(response);
                    this.list = response.data;
                })
            }
        }
    }
</script>
