<template>
    <div>
        <slot></slot>
    </div>
    <div v-show="show" class="feedContent" >
        <my-post v-for="item in items" :item="item"></my-post>
    </div>
</template>

<script>
import MyPost from "./MyPost.vue";
export default {
    name: "FeedContent",
    components: {MyPost},
    props: {
        show: {
            default: false,
            type: Boolean,
        },
        items: {
            default: [],
            type: Array,
        }
    }
}
</script>

<style scoped>
.feedContent{
    display: flex;
    flex-direction: column;
    width: available;
    height: available;
    overflow-y: scroll;
}
.feedContent::-webkit-scrollbar{
    display: none;
}
</style>
