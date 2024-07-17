<template>
    <img class="img" v-show="file.type === 'imgs'" @click="showImg(file.url)" :src="'../../../' + file.url">
    <img-modal v-model:show="showImgModal">
        <img :src="this.currentImg">
    </img-modal>
    <div v-show="file.type === 'vids'">
        <video class="video" :src="'../../../' + file.url" controls></video>
    </div>
    <div v-show="file.type === 'other'">
        <a :href="'../../../' + file.url">Ссылка</a>
    </div>
</template>

<script>
export default {
    name: "MyFile",
    data(){
        return{
            showImgModal: false,
            currentImg: '',
        }
    },
    props: {
        file: {
            type: Object,
        },
        type: {
            type: String
        }
    },
    methods: {
        showImg(img){
            this.currentImg = '../../../' + img;
            this.showImgModal = true;
        }
    }
}
</script>

<style scoped>
.video {
    width: clamp(60rem, 0.25rem + 2vw, 2rem);
}
.img {
    cursor: pointer;
    margin: 5px;
    width: clamp(7rem, 0.25rem + 2vw, 2rem);
    min-width: 7rem;
}
</style>
