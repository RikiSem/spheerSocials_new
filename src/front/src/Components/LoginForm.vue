<template>
    <form @submit.prevent>
        <h1 class="dialogHeader">Вход</h1>
        <error-msg :msg="errorMsg"></error-msg>
        <success-msg :msg="successMsg"></success-msg>
        <my-input-login @changeLogin="setLogin"></my-input-login>
        <my-input-pass @changePass="setPass"></my-input-pass>
        <MyButton @click="auth">Войти</MyButton>
    </form>
</template>

<script>

export default {
    name: "LoginForm",
  data() {
        return {
            errorMsg: '',
            successMsg: '',
            loginAuth: {
              login: '',
              pass: '',
            }
        }
    },
    methods:{
        setLogin(login){
            this.loginAuth.login = login;
        },
        setPass(pass){
            this.loginAuth.pass = pass;
        },
        setErrorMsg(text) {
            this.errorMsg = text;
        },
        setSuccessMsg(text)
        {
          this.successMsg = text
        },
        async auth(){
            try {
                const response = await axios.post(this.coreUrl + '/api/login', this.loginAuth);
                this.$emit('cookie', response.data.content);
                this.$router.push({
                    name: `homePage`,
                    params: {
                        userId: response.data.content.userId
                    }
                });
            } catch (e) {
                this.setErrorMsg(e.response.data.content);
            }
        }
    }
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
