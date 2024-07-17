<template>
    <user-page-component>
        <div v-test class="userSettings">
            <strong class="display-6"> Настройки профиля </strong>
                <div class="avatarSetting">
                    <img class="avatarImg" :src="this.avatarPic">
                    <input type="file" name="avatar" accept=".png .jpeg .jpg .gif">
                </div>
            <my-input-login></my-input-login>
            <my-input-pass></my-input-pass>
            <textarea-about></textarea-about>
            <my-button>Сохранить</my-button>
            <my-button-red @click="show = true">Удалить профиль</my-button-red>
            <my-dialog v-model:show="show">
                <p>
                    Вы точно хотите удалить профиль?
                    Восстановить его будет невозможно.
                </p>
                <my-button-red>Удалить профиль</my-button-red>
            </my-dialog>
        </div>
    </user-page-component>
</template>

<script>
import UserPageComponent from "../Components/UserPageComponent.vue";
import axios from "axios";
export default {
    name: "MainPage",
    components: {UserPageComponent},
    data(){
        return{
            avatarPic: '',
            show: false
        }
    },
    mounted() {
        this.getAvatar();
        document.title = 'Профиль';
    },
    methods: {
        async getAvatar(){
            const response = await axios.get(this.coreUrl + `/api/user/${ this.$route.params.userId }/getAvatar`);
            this.avatarPic = response.data.content;
        }
    }
}
</script>

<style scoped>
.avatarSetting{
    width: min-content;
    padding: 5px;
    display: flex;
    margin-left: auto;
    margin-right: auto;
    flex-direction: column;
}
.avatarImg{
    margin: auto;
    width: clamp(15rem, 0.25rem + 2vw, 2rem);
    border-radius: 50%;
}
.userSettings{
    display: flex;
    flex-direction: column;
    margin-left: auto;
    margin-right: auto;
}
</style>
