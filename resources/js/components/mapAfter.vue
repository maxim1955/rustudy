<template>
    <div class="order__block flex flex-between choice">
            <div class="choice__container">
                <p class="choice__title">Отделения Почты России</p>
                <p class="choice__address">{{ checkAddress.address }}</p>
                <p v-if="checkAddress.time" class="choice__time">{{ checkAddress.time[0] }}</p>
                <p v-else-if="!checkAddress.time" class="choice__time"></p>
                
            </div>
            <button type="button" class="btn-reset btn-background choice__btn" @click="$emit('back')">Изменить отделение</button>
            <div class="choice__map">
                <div id="mapAfter" style="width: 100%; height: 100%"></div>
            </div>
            
    </div>
</template>

<script>
import usePostcodeStore from '@/stores/PostcodeStore.js'
    export default {
        data() {
            return {
            }
        },
        props: ['activeCity'],
        mounted() {

                const myMapAfter = new ymaps.Map("mapAfter", {
            center: [this.checkAddress.lat, this.checkAddress.lon],
            zoom: 12,
            controls: []
            });

            var myPlacemark = new ymaps.Placemark([this.checkAddress.lat, this.checkAddress.lon], {}, {
                iconLayout: 'default#image',
                iconImageHref: 'img/map-icon.svg',
                iconImageSize: [32, 40],
            });
            myMapAfter.geoObjects.add(myPlacemark);
            
              
        },

        computed: {
            checkAddress() {
                const PostcodeStore = usePostcodeStore()
                return PostcodeStore.checkAddress 
            }
        }

    }
</script>