<template>
    <strong class="lead"><slot></slot></strong> <textarea @change="$emit('changeTextareaAbout', this.text)" v-model="text" rows="5" name="about"></textarea>
</template>

<script>
export default {
    name: "TextareaAbout",
    data(){
        return {
            text: ''
        }
    }
}
</script>

<style scoped>
textarea{
    padding: 7px;
    width: 100%;
    margin: 5px;
    border: 1px solid var(--color);
    border-radius: 10px;
}
</style>
