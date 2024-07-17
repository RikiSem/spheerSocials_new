<template>
    <div class="postControl">
        <div class="iconDiv">
            <svg class="likeIcon transition icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
            <span class="margin">0</span>
        </div>
        <div class="iconDiv">
            <svg class="shareIcon transition icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 2.1l4 4-4 4"/>
                <path d="M3 12.2v-2a4 4 0 0 1 4-4h12.8M7 21.9l-4-4 4-4"/>
                <path d="M21 11.8v2a4 4 0 0 1-4 4H4.2"/>
            </svg>
            <span class="margin">0</span>
        </div>
        <div class="iconDiv">
            <svg class="commentIcon transition icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 9.5H3M21 4.5H3M21 14.5H3M21 19.5H3"/>
            </svg>
            <span class="margin">0</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "PostControlPanel"
}
</script>

<style scoped>
.postControl{
    display: flex;
    width: 100%;
}
.iconDiv{
    cursor: pointer;
    border: 1px solid var(--color);
    border-radius: 5px;
    padding: 2px;
    margin: 5px;
    display: flex;
}
.iconDiv:hover{
    background-color: var(--color);
}
.iconDiv:hover span{
    color: white;
}
.iconDiv:hover svg{
    filter: invert(100);
}
.icon{
    align-self: center;
}
.transition{
    transition: 0.25s;
}
.margin{
    margin: 5px;
}
</style>
