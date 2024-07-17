<template>
    <div class="post">
        <div class="feedItemHeader">
            <p>{{ item.created_at }}</p>
        </div>
        <div class="feedItemBody">
            <p>{{ item.text }}</p>
            <div class="feedItemFiles">
                <my-file v-for="file in item.files" :file="file"></my-file>
            </div>
            <post-control-panel></post-control-panel>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        item: {
            type: Object
        }
    },
    name: "MyPost"
}
</script>

<style scoped>
.post{
    padding: 5px;
    min-width: 70%;
    margin: 5px auto;
    border-radius: 7px;
    border: 1px solid var(--color);
}
.feedItemFiles{
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    align-content: flex-start;
}
</style>
