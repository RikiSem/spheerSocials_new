<template>
    <input @change="$emit('changeLogin', this.login)" v-model="login" type="text" placeholder="Логин" required>
</template>

<script>
export default {
    name: "MyInputLogin",
    data(){
        return {
            login: ''
        }
    }

}
</script>

<style scoped>
    *{
        padding: 7px;
        width: 100%;
        margin: 5px;
        border: 1px solid var(--color);
        border-radius: 10px;
    }
</style>
