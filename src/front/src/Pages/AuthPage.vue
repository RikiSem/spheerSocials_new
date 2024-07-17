<template>
    <div class="container">
        <my-header></my-header>
        <div class="content row">
            <my-dialog class="formLogin" v-model:show="dialogLoginVisible">
                <login-form @cookie="setCookie"></login-form>
            </my-dialog>
            <my-dialog class="formReg" v-model:show="dialogRegVisible">
                <my-reg-form @cookie="setCookie"></my-reg-form>
            </my-dialog>
            <div class="auth_btns">
                <my-button @click="dialogLoginVisible = true">Вход</my-button>
                <my-button @click="dialogRegVisible = true">Регистрация</my-button>
            </div>
        </div>
        <my-footer></my-footer>
    </div>
</template>

<script>
import axios from "axios";
import { useCookies } from "vue3-cookies";

export default {
    name: "AuthPage",
    setup() {
      const { cookies } = useCookies();
      return { cookies };
    },
    data() {
        return {
            dialogLoginVisible: false,
            dialogRegVisible: false
        }
    },
    methods: {
      setCookie(data) {
        this.cookies.set("auth", data, '30d');
      }
    }
}
</script>

<style scoped>
.content{
    display: flex;
    margin: auto;
    height: 100%;
}
.auth_btns {
    display: flex;
    margin: auto;
}
</style>
