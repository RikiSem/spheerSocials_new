<template>
    <form enctype="multipart/form-data" v-if="show" class="newPostForm" @submit.prevent>
        <textarea class="margin" v-model="text" rows="5" placeholder="Текст"></textarea>
        <input class="margin" ref="file" type="file" multiple>
        <my-button class="margin" @click="createPost">Отправить</my-button>
    </form>
</template>

<script>
import axios from "axios";
export default {
    name: "NewPostForm",
    props: {
        show: {
            default: false,
            type: Boolean,
        },
    },
    data() {
        return {
            text: '',
            files: [],
        }
    },
    methods:{
        async createPost() {
            const fileData = new FormData();
            for (var i = 0; i < this.$refs.file.files.length; i++ ){
                let file = this.$refs.file.files[i];
                fileData.append(`postFiles[${ i }]`, file);
            }
            fileData.append('text', this.text);
            fileData.append('userId', this.$route.params.userId);
            fileData.append('socialId', this.$route.params.id);
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }
            const response = await axios.post(this.coreUrl + '/api/post/create', fileData, config);
            this.text = '';
            this.files = [];

            this.$emit('test');
        },
    }
}
</script>

<style scoped>
.margin{
    margin: 5px;
}
.newPostForm{
    width: min-content;
    display: flex;
    flex-direction: column;
    margin: auto;
    align-items: center;
}
.newPostForm textarea {
    width: 100%;
}
</style>
