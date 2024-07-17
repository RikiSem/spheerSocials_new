<template>
    <button class="btn"><slot></slot></button>
</template>

<script>
export default {
    name: "ReactionBtn"
}
</script>

<style scoped>
.btn{
    display: flex;
    background-color: white;
    margin: 5px;
    word-wrap: break-word;
    transition: 0.25s;
}
</style>
