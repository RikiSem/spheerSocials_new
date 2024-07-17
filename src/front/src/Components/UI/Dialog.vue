<template>
    <div v-if="show" class="mainDialog" @click="hideDialog">
        <div @click.stop class="dialog">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "MyDialog",
    props:{
        show:{
            type: Boolean,
            default: false,
        }
    },
    methods:{
        hideDialog() {
            this.$emit('update:show', false);
        }
    }
}
</script>

<style scoped>
    .mainDialog{
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.5);
        position: fixed;
        display: flex;
    }
    .dialog{
        max-width: 35rem;
        display: flex;
        flex-direction: column;
        padding: 10px;
        margin: auto;
        background: white;
        border-radius: 10px;
        align-items: center;
    }
</style>
