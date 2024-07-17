<template>
    <button class="btn"><slot></slot></button>
</template>

<script>
export default {
    name: "MyButtonRed"
}
</script>

<style scoped>
    .btn{
        padding: 7px 15px 7px 15px;
        border: 1px solid #ad2828;
        border-radius: 10px;
        background-color: white;
        margin: 5px;
        word-wrap: break-word;
        transition: 0.25s;
    }
    .btn:hover{
        background-color: #ad2828;
        color: white;
    }
</style>
