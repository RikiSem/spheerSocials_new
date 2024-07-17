<template>
    <form @submit.prevent>
        <h1 class="dialogHeader">Регистрация</h1>
        <error-msg :errorMsg="errorMsg"></error-msg>
        <my-input-login @changeLogin="setLogin"></my-input-login>
        <my-input-mail @changeEmail="setMail"></my-input-mail>
        <my-input-pass @changePass="setPass"></my-input-pass>
        <MyButton @click="sendInfo">Регистрация</MyButton>
    </form>
</template>

<script>
import axios from "axios";

export default {
    name: "MyRegForm",
    data() {
        return {
            errorMsg: '',
            loginAuth: {
                login: '',
                mail: '',
                pass: '',
            }
        }
    },
    methods: {
        setLogin(login) {
            this.loginAuth.login = login;
        },
        setPass(pass) {
            this.loginAuth.pass = pass;
        },
        setMail(mail) {
            this.loginAuth.mail = mail;
        },
        setErrorMsg(text)
        {
            this.errorMsg = text;
        },
        async sendInfo(){
            try {
                const response = await axios.post(this.coreUrl + `/api/registration`, this.loginAuth);
                this.$emit('cookie', response.data.content)
                if (resp.status === 200) {
                    this.$router.push({
                        name: `homePage`,
                        params: {
                            userId: response.data.content.userId
                        }
                    });
                }
            } catch (e) {
                this.setErrorMsg(e.response.data.content);
            }
        }
    },
}
</script>

<style scoped>
* {
    display: flex;
    flex-direction: column;
    align-items: center;
}
h1{
    text-align: center
}
</style>
