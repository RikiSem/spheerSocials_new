<template>
    <button class="btn"><slot></slot></button>
</template>

<script>
export default {
    name: "MyButton"
}
</script>

<style scoped>
    .btn{
        display: flex;
        justify-content: center;
        padding: 7px 15px 7px 15px;
        border: 1px solid var(--color);
        border-radius: 10px;
        background-color: white;
        margin: 5px;
        word-wrap: break-word;
        transition: 0.25s;
    }
    .btn:hover{
        background-color: var(--color);
        color: white;
    }
</style>
