<template>
    <input @change="$emit('changeEmail', this.email)" v-model="email" type="email" placeholder="Почта" required>
</template>

<script>
export default {
    name: "MyInputMail",
    data(){
        return {
            email: ''
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
