<template>
    <div class="game_wrapper" v-if="!gameStart">
        <div class="game_wrapper_box">
            <div class="">
                <p>Играй и изучай русский язык вместе с нами</p>
                <span>
          Игра для уровня A1
        </span>
            </div>
            <div class="">
                <button @click="startGame()">Играть бесплатно</button>

            </div>
        </div>
    </div>
    <template v-if="gameStart">
        <div>
            <div id="unity-container" class="unity-desktop">
                <canvas id="unity-canvas"></canvas>
            </div>
            <div id="loading-cover">
                <div id="unity-loading-bar">
                    <div id="unity-logo"><img src="RKI_games/logo.png"></div>
                    <div id="unity-progress-bar-empty" style="display: none;">
                        <div id="unity-progress-bar-full"></div>
                    </div>
                    <div class="spinner"></div>
                </div>
            </div>
            <div id="unity-fullscreen-button" style="display: none;"></div>
        </div>
    </template>
</template>
<script setup>
import {onMounted, ref} from "vue";
import {useHead} from "unhead";

let gameStart = ref(false)
let initGame = () => {
    const hideFullScreenButton = "true";
    const buildUrl = "../RKI_games/Build";
    const loaderUrl = buildUrl + "/RKI_games.loader.js";
    const config = {
        dataUrl: buildUrl + "/RKI_games.data",
        frameworkUrl: buildUrl + "/RKI_games.framework.js",
        codeUrl: buildUrl + "/RKI_games.wasm",
        streamingAssetsUrl: "StreamingAssets",
        companyName: "DefaultCompany",
        productName: "RKI Games",
        productVersion: "1.0",
    };

    const container = document.querySelector("#unity-container");
    const canvas = document.querySelector("#unity-canvas");
    const loadingCover = document.querySelector("#loading-cover");
    const imagePrevious = document.querySelector('#loading-cover img')
    const progressBarEmpty = document.querySelector("#unity-progress-bar-empty");
    const progressBarFull = document.querySelector("#unity-progress-bar-full");
    const fullscreenButton = document.querySelector("#unity-fullscreen-button");
    const spinner = document.querySelector('.spinner');

    console.log(container)
    const canFullscreen = (() => {
        for (const key of [
            'exitFullscreen',
            'webkitExitFullscreen',
            'webkitCancelFullScreen',
            'mozCancelFullScreen',
            'msExitFullscreen',
        ]) {
            if (key in document) {
                return true;
            }
        }
        return false;
    })();

    if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
        container.className = "unity-mobile";
        config.devicePixelRatio = 1;
    }
    loadingCover.style.display = "";

    const script = document.createElement("script");
    script.src = loaderUrl;
    script.onload = () => {
        imagePrevious.src = '/RKI_games/logo.png';
        createUnityInstance(canvas, config, (progress) => {
            spinner.style.display = "none";
            progressBarEmpty.style.display = "";
            progressBarFull.style.width = `${100 * progress}%`;

        }).then((unityInstance) => {
            imagePrevious.src = '/RKI_games/logo.png';
            loadingCover.style.display = "none";
            if (canFullscreen) {
                if (!hideFullScreenButton) {
                    fullscreenButton.style.display = "";
                }
                fullscreenButton.onclick = () => {
                    unityInstance.SetFullscreen(1);
                };
            }
        }).catch((message) => {
            alert(message);
        });
    };
    document.body.appendChild(script);
}
let startGame = () => {
    gameStart.value = true
    setTimeout(() => {
        initGame()
    }, 500)

}
onMounted(() => {
    useHead({
        title: 'Игра онлайн по русскому как иностранному (game rki)',
        meta: [
            {
                name: 'title',
                content: 'Игра онлайн по русскому как иностранному (game rki)'
            },
            {
                name: 'keywords',
                content: 'игра РКИ онлайн, rki, game rki, играй и изучай русский язык, русский как иностранный'
            },
            {
                name: 'description',
                content: 'Онлайн-игра для изучения русского языка как иностранного. | Online game for learning Russian as a foreign language. | Rus.Study'
            }
        ],

    })

    if (gameStart.value) {
        initGame()
    }
})

</script>
<style scoped>


</style>
