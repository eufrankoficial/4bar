<template>
    <ul class="nav navbar-nav">
        <li class="form-group mt-2">
            <select v-model="branch" class="form-control" @change="changeBranch($event)" :disabled="branchs.length == 1">
                <option v-for="branch in branchs"
                        :value="branch.slug"
                >
                    {{ branch.name }}
                </option>
            </select>
        </li>
    </ul>
</template>

<script>

    import { http } from '../../config';

    export default {
        props: ['user_branchs', 'current_branch_user', 'changebranchurl'],

        mounted() {

            this.branch = this.current_branch.slug;
        },


        data() {
            return {
                branchs: JSON.parse(this.user_branchs),
                current_branch: JSON.parse(this.current_branch_user),
                branch: null
            }
        },

        methods: {
            changeBranch: async function(event) {

                document.getElementById('pageLoader').style.display = 'block';
                const response = await http.get(this.changebranchurl + '/' + this.branch);

                window.history.pushState({},"", response.data.route);

                setTimeout(function(){
                    location.reload();
                }, 2000)
            }
        }
    };
</script>
