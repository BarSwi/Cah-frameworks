
<template>
    <top-navbar></top-navbar>
    <div id="container-home">
        <h1>
            TYTUŁ
        </h1>
        <h2>
            opis
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi diam odio, egestas nec tortor non, posuere viverra justo. Mauris dui metus, pellentesque ut elementum eget, mollis ac sapien. Nunc ligula elit, rutrum quis augue a, consectetur cursus orci. Suspendisse potenti. Vivamus nunc diam, pharetra id pretium sed, lobortis ut ligula. Phasellus porta risus quis vestibulum ornare. Integer ac mauris rutrum, ullamcorper massa id, tempor lorem. Morbi malesuada nulla nec elit condimentum, eu egestas neque rhoncus.

            Donec ac fringilla nunc. Integer vitae elementum justo. Morbi sed urna consectetur, posuere tortor eget, congue arcu. Pellentesque ut est nec dolor posuere pharetra a a lectus. Donec eget interdum nunc, quis efficitur lacus. Proin augue risus, ultricies sit amet risus vel, porta posuere tortor. Duis elementum fermentum risus nec tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum vulputate pellentesque eros, vestibulum commodo arcu efficitur tincidunt. Praesent pretium varius velit, in tempor sem sagittis id.
        </h2>
        <div id="game-selection-home">
            <game-selection></game-selection>
        </div>
    </div>
</template>
<style lang = "scss">
    #container-home{
        width: 75%;
        margin: 0 auto 0 auto;
        text-align: center;
        h1{
            margin: 50px 0 50px 0;
        }
        h2{
            margin: 50px 0 50px 0;
        }
    }
</style>

<script>
import topNavbar from "../components/topNavbar.vue"
import gameSelection from "../components/gameSelection.vue";
export default {

  data: function () {
    return {
    
    }
  },
  components:
    {
        topNavbar,
        gameSelection,
    },
  }
</script>
