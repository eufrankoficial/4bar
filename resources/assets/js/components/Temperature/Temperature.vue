<template>
    <div id="navbar-menu">
        <ul class="nav navbar-nav">
            <li class="margin-0">
                <a href="javascript:void(0);" class="right_toggle icon-menu" :title="name">
                    {{ temperature }}°C
                    <span>
                    <img :src="image" :alt="coldchamber.name" width="30" height="30">
                </span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>

    import { http } from '../../config';

    export default {
        props: ['image', 'coldchamber', 'temperaturechamber', 'url'],

        created() {

                setInterval(this.getTemperature, 20000);


        },

        data() {
            return {
                temperature: this.temperaturechamber,
                name: this.coldchamber.name
            }
        },

        methods: {

            /**
             * @param event
             */
            getTemperature: async function() {
                const response = await http.get(this.url);
                if(response.data) {
                    const current = response.data.current;
                    const coldChambers = response.data.current;

                    this.name = current.name;
                    this.temperature = current.temperature;
                    this.image = current.image_temperature;
                }
            }
        }
    };
</script>
