<template>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Simple Vue.js Pagination Example with Laravel - <a href="https://techvblogs.com/?ref=scode" target="_blank">TechvBlogs</a></h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>001</td>
                                        <td>aris</td>
                                        <td>dovi</td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td align="center" colspan="3">No record found.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <pagination align="center" :data="users" @pagination-change-page="list"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import pagination from 'laravel-vue-pagination'
    export default {
        name:"appointments",
        components:{
            pagination
        },
        data(){
            return {
                users:{
                    type:Object,
                    default:null
                }
            }
        },
        mounted(){
            this.list()
        },
        methods:{
            async list(page=1){
                await axios.get(`/api/users?page=${page}`).then(({data})=>{
                    this.users = data
                }).catch(({ response })=>{
                    console.error(response)
                })
            }
        }
    }
</script>
<style scoped>
    .pagination{
        margin-bottom: 0;
    }
</style>