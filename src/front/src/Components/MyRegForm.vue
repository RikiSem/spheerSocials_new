<template>
    <form @submit.prevent>
      <h1 class="dialogHeader">Регистрация</h1>
      <error-msg :msg="errorMsg"></error-msg>
      <success-msg :msg="successMsg"></success-msg>
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
          successMsg: '',
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
        setSuccessMsg(text)
        {
            this.successMsg = text
        },
        async sendInfo(){
            try {
                const response = await axios.post(this.coreUrl + `/api/registration`, this.loginAuth);
                this.$emit('cookie', response.data.content)
                if (response.status === 200) {
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
