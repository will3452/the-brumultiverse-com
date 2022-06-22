<style>
    * {
    box-sizing: border-box;
    }

    body {
    background: rebeccapurple;
    }

    h1.loader {
    color: #FFFFFF;
    text-align: center;
    font-family: sans-serif;
    text-transform: uppercase;
    font-size: 20px;
    position: relative;
    }

    h1.loader:after {
    position: absolute;
    content: "";
    -webkit-animation: Dots 2s cubic-bezier(0, .39, 1, .68) infinite;
    animation: Dots 2s cubic-bezier(0, .39, 1, .68) infinite;
    }

    #loader-container {
        width:100vw;
        height:100vh;
        background:#442277;
        position: fixed;
        z-index: 999;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    div.loader {
    margin: 5% auto 30px;
    top:0px;
    }

    .book {
    border: 4px solid #FFFFFF;
    width: 60px;
    height: 45px;
    position: relative;
    perspective: 150px;
    }

    .page {
    display: block;
    width: 30px;
    height: 45px;
    border: 4px solid #FFFFFF;
    border-left: 1px solid #8455b2;
    margin: 0;
    position: absolute;
    right: -4px;
    top: -4px;
    overflow: hidden;
    background: #8455b2;
    transform-style: preserve-3d;
    -webkit-transform-origin: left center;
    transform-origin: left center;
    }

    .book .page:nth-child(1) {
    -webkit-animation: pageTurn 1.2s cubic-bezier(0, .39, 1, .68) 1.6s infinite;
    animation: pageTurn 1.2s cubic-bezier(0, .39, 1, .68) 1.6s infinite;
    }

    .book .page:nth-child(2) {
    -webkit-animation: pageTurn 1.2s cubic-bezier(0, .39, 1, .68) 1.45s infinite;
    animation: pageTurn 1.2s cubic-bezier(0, .39, 1, .68) 1.45s infinite;
    }

    .book .page:nth-child(3) {
    -webkit-animation: pageTurn 1.2s cubic-bezier(0, .39, 1, .68) 1.2s infinite;
    animation: pageTurn 1.2s cubic-bezier(0, .39, 1, .68) 1.2s infinite;
    }


    /* Page turn */

    @-webkit-keyframes pageTurn {
    0% {
        -webkit-transform: rotateY( 0deg);
        transform: rotateY( 0deg);
    }
    20% {
        background: #4b1e77;
    }
    40% {
        background: rebeccapurple;
        -webkit-transform: rotateY( -180deg);
        transform: rotateY( -180deg);
    }
    100% {
        background: rebeccapurple;
        -webkit-transform: rotateY( -180deg);
        transform: rotateY( -180deg);
    }
    }

    @keyframes pageTurn {
    0% {
        transform: rotateY( 0deg);
    }
    20% {
        background: #4b1e77;
    }
    40% {
        background: rebeccapurple;
        transform: rotateY( -180deg);
    }
    100% {
        background: rebeccapurple;
        transform: rotateY( -180deg);
    }
    }


        /* Dots */

        @-webkit-keyframes Dots {
        0% {
            content: "";
        }
        33% {
            content: ".";
        }
        66% {
            content: "..";
        }
        100% {
            content: "...";

        content: ".";
    }
    66% {
        content: "..";
    }
    100% {
        content: "...";
    }
    }
</style>
<div id="loader-container">
    <div class="loader book">
        <figure class="page"></figure>
        <figure class="page"></figure>
        <figure class="page"></figure>
      </div>
      <h1 class="loader">Loading</h1>
</div>
