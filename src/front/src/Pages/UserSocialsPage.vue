<template>
    <user-page-component>
        <div class="socialPage">
            <strong class="display-6"> Ваши сообщества </strong>
            <div>
                <strong class="lead">Доступно {{ this.user.limit - this.joinedSocials.length }} из {{ this.user.limit }} сообществ для добавления</strong>
                <my-button @click="show = true">+ Сообщество</my-button>
                <my-dialog v-model:show="show">
                    <my-button @click="showCreateSocialDialog = true">Создать свое</my-button>
                    <my-dialog v-model:show="showCreateSocialDialog">
                        <error-msg :errorMsg="createNewSocialSocialError"></error-msg>
                        <my-input @changeInput="setNewSocialName" v-model:name="newSocial.name">Название сообщества</my-input>
                        <textarea-about @changeTextareaAbout="setNewSocialDescription" v-model:text="newSocial.description">Описание сообщества</textarea-about>
                        <my-button @click="createNewSocial">Создать</my-button>
                    </my-dialog>
                    <span class="lead"> или </span>
                    <my-input v-model:name="searchInput" @changeInput="searchSocials">искать по названию</my-input>
                    <div class="searchByNameDiv"></div>
                    <my-socials-list @joinSocial="joinToSocial" :items="searchSocialsResult"></my-socials-list>
                </my-dialog>
            </div>
            <my-socials-list class="socialsList" :items="joinedSocials"></my-socials-list>
        </div>
    </user-page-component>
</template>

<script>
import UserPageComponent from "../Components/UserPageComponent.vue";
import axios from "axios";
import {useRoute} from "vue-router";
export default {
    name: "MainPage",
    components: {UserPageComponent},
    data(){
        return{
            createNewSocialSocialError: '',
            user: '',
            show: false,
            showCreateSocialDialog: false,
            joinedSocials: [],
            newSocial: {
                name: '',
                description: '',
                author: this.$route.params.userId,
            },
            searchSocialsResult: [],
        }
    },
    mounted(){
        document.title = 'Сообщества';
        this.getUser();
        this.getSocials();
    },
    methods:{
        alertWarning(message) {
            alert(message);
        },
        isAvailableJoinToSocial() {
            return this.user.limit - this.joinedSocials.length > 0;
        },
        redirectToSocial(socialId) {
            this.$router.push({
                name: 'socialFeed',
                params: {
                    id: socialId,
                    userId: this.$route.params.userId
                }
            });
        },
        async joinToSocial(socialId) {
            if(this.isAvailableJoinToSocial()) {
                const response = await axios.post(this.coreUrl + `/api/socials/join/${ socialId }/${ this.$route.params.userId }`);
                if (response.status === 200) {
                    this.redirectToSocial(socialId)
                }
            } else {
                this.alertWarning('Превышен лимит по количеству сообществ');
            }
        },
        async getUser()
        {
            this.user = (await axios.get(this.coreUrl + `/api/user/${ this.$route.params.userId }/get`)).data.content;
        },
        async searchSocials(name) {
            try {
                this.searchSocialsResult = (await axios.get(this.coreUrl + `/api/socials/search/${name}/${ this.$route.params.userId }`)).data.content;
            } catch(e) {
                console.log(e)
            }
        },
        async getSocials(){
            try {
                this.joinedSocials = (await axios.get(this.coreUrl + `/api/socials/getUserSocials/${ this.$route.params.userId }`)).data.content;
            } catch(e) {
                console.log(e)
            }
        },
        setNewSocialName(name){
            this.newSocial.name = name;
        },
        setNewSocialDescription(description){
            this.newSocial.description = description;
        },
        setErrorMsg(text) {
            this.createNewSocialSocialError = text
        },
        async createNewSocial(){
            try {
                if(this.isAvailableJoinToSocial()) {
                    const response = await axios.post(this.coreUrl + `/api/socials/create`, this.newSocial);
                    this.redirectToSocial(response.data.content)
                } else {
                    this.setErrorMsg('Превышен лимит по количеству сообществ');
                }

            } catch(e) {
                this.setErrorMsg(e.response.data.content);
            }
        }
    }
}
</script>

<style scoped>
.socialPage{
    display: flex;
    flex-direction: column;
    margin-left: auto;
    margin-right: auto;
}

.searchByNameDiv{
    width: 100%;
    border-bottom: 3px solid #4949a7;
}

</style>
