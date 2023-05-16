<template>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Organization</label>
                <select v-model="organization_id" class="form-control custom-select" name="organization_id" @change="getBranchs($event)" required>
                    <option value="">Choose</option>
                    <option v-for="org in orgs" :value="org.id">{{ org.name }}</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6" v-if="organization_id">
            <div class="form-group">
                <label>Branch</label>
                <select v-model="branch_id" class="form-control custom-select" name="branch_id" required>
                    <option value="">Choose</option>
                    <option v-for="branch in branchs" :value="branch.id">{{ branch.name }}</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['orgsselect', 'org', 'branch'],

        created() {

            if(this.organization_id) {
                this.getBranchs();
            }

        },

        data() {
            return {
                organization_id: this.org !== 'false' ? this.org : null,
                branch_id: this.branch !== 'false' ? this.branch : null,
                orgs: JSON.parse(this.orgsselect),
                branchs: null
            }
        },


        methods: {

            /**
             * @param event
             */
            getBranchs: function(event) {
                const orgId = this.organization_id;

                this.branchs = this.orgs.filter( function(org) {
                    return org.id == orgId;
                })[0].branchs;
            }
        }
    };
</script>
