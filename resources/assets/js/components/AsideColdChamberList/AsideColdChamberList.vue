<template>
    <div class="tab-pane vivify fadeIn delay-100 active" id="Chat-one">
        <div class="chat_detail">
            <ul class="chat-widget clearfix">
                <li class="left float-left" v-for="coldChamber in coldChambers">
                    <div class="chat-info">
                        <div class="card">
                            <div class="body">
                                <div class="card-value float-right" :class="coldChamber.class">
                                    <i class="wi wi-thermometer-exterior"></i>
                                </div>
                                <h3 class="mb-1">{{ coldChamber.temperature ? coldChamber.temperature : 'n/n' }} °C</h3>
                                <div>{{ coldChamber.name }}</div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>



<script>

    import {http} from "../../config";

    export default {
        props: ['coldchambersprop', 'url'],

        created() {
            setInterval(this.getTemperature, 20000);
        },


        data() {
            return {
                coldChambers: JSON.parse(this.coldchambersprop),
            }
        },

        methods: {

            /**
             * @param event
             */
            getTemperature: async function() {
                const response = await http.get(this.url);
                if(response.data) {
                    this.coldChambers = response.data.list;
                }
            }
        }
    };
</script>
