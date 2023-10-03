<template>
    <div class="game-selection">
        <div class="game">testtesttesttest</div>
        <div class="game">tests</div>
        <div class="game">transparent</div>
        <div class="game">test</div>
    </div>
</template>
<style lang="scss">
    .game-selection{
        margin-top: 150px;
        width: 100%;
        height: clamp(100px, 100px, 150px);
        background-color: red;
        flex-wrap: wrap;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        .game{
            width: 20%;
            min-width: max-content;
            padding: 10px;
        }
    }
</style>
