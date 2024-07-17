<template>
    <span class="lead"><slot></slot></span> <input @change="$emit('changeInput', this.name)" v-model="name" type="text" name="name">
</template>

<script>
export default {
    name: "MyInput",
    data(){
        return {
            name: ''
        }
    }
}
</script>

<style scoped>
input{
    padding: 7px;
    width: 100%;
    margin: 5px;
    border: 1px solid var(--color);
    border-radius: 10px;
}
</style>
