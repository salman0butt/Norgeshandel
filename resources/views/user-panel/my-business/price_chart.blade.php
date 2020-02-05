@extends('layouts.landingSite')

@section('page_content')
<style>
    .triger-btn {
        background-color: #ECDFE2;
        border-radius: 8px;
        font-size: 16px;
        line-height: 22px;
        padding: 16px;
        width: 100%;
        display: flex;
        flex: 1 1 auto;
        text-align: left;
        cursor: pointer;
        border: 0;
        outline: none;
        font-size: 16px;
        line-height: 22px;
    }

    .expansion-panel__details {
        margin-left: 10px;
    }

    tr {
        line-height: 40px;
    }

</style>
<div class="dme-container">

    <div class="pageholder mt-5">
        <div class="mt-5 mb-5">
            <h1 style="margin-top:8%;">Prisoversikt</h1>
        </div>
        <div class="grid">
            <div class="grid__unit row">
                <div id="price-info-root" class="col-md-8">
                    <p class="u-mb32 pb-2">Annonsepriser beregnes ut fra hvor mange annonser din bedrift har lagt ut i løpet
                        av de siste 12 månedene. Her finner du prisen på den neste annonsen du legger ut. </p>
                    <div>
                        <p class="u-t3">Jobb</p>
                        <div class="form-group"><button type="button" class="triger-btn triger-btn1">
                                <div class="expansion-panel__summary">
                                    <div><span class="u-strong u-pr16">Heltidsstilling og lederstilling</span>
                                        9&nbsp;990 kr</div>
                                </div>
                                 <i class="fas fa-chevron-up" style="position:absolute;right:30px;"></i>
                            </button>
                            <div class="expansion-panel__details collapse" id="multiCollapseExample1">
                                <table class="data-table mt-2 col-md-5">
                                    <thead>
                                        <tr>
                                            <th class="u-t5 text-muted">Antall annonser</th>
                                            <th class="u-t5 text-muted">Pris</th>
                                            <th class="u-t5"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="bounds-width">0 - 5</td>
                                            <td class="">9&nbsp;990</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">6 - 10</td>
                                            <td class="">7&nbsp;990</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">11 - 20</td>
                                            <td class="">6&nbsp;890</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">21 - 50</td>
                                            <td class="">6&nbsp;290</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">51 - 100</td>
                                            <td class="">5&nbsp;640</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">101 - 200</td>
                                            <td class="">5&nbsp;200</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">201 - 300</td>
                                            <td class="">4&nbsp;490</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">301 - 400</td>
                                            <td class="">4&nbsp;100</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">401 - 500</td>
                                            <td class="">3&nbsp;390</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">500+</td>
                                            <td class="">2&nbsp;900</td>
                                            <td></td>
                                        </tr>
                                    </tbody>

                                </table>
                                <caption>
                                    <p class="u-t5">Alle priser er i NOK, gjelder pr. annonse og er ekskl.
                                        moms</p>
                                </caption>
                            </div>
                        </div>
                       
                        <div class="form-group" style="margin-top:20px"><button type="button" class="triger-btn triger-btn2">
                                <div class="expansion-panel__summary">
                                    <div><span class="u-strong u-pr16">Deltidsstilling</span> 4&nbsp;990 kr</div>
                                </div>
                                 <i class="fas fa-chevron-up" style="position:absolute;right:30px;"></i>
                            </button>
                            <div class="expansion-panel__details collapse multi-collapse" id="multiCollapseExample2">
                                <table class="data-table mt-2 col-md-5">
                                    <thead>
                                        <tr>
                                            <th class="u-t5 text-muted">Antall annonser</th>
                                            <th class="u-t5 text-muted">Pris</th>
                                            <th class="u-t5 text-muted"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="bounds-width">0 - 5</td>
                                            <td class="">4&nbsp;990</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">6 - 10</td>
                                            <td class="">3&nbsp;490</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">11 - 20</td>
                                            <td class="">2&nbsp;920</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">21 - 50</td>
                                            <td class="">2&nbsp;650</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">51 - 100</td>
                                            <td class="">2&nbsp;340</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">101 - 200</td>
                                            <td class="">1&nbsp;910</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">201 - 300</td>
                                            <td class="">1&nbsp;660</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">301 - 400</td>
                                            <td class="">1&nbsp;540</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">401 - 500</td>
                                            <td class="">1&nbsp;420</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bounds-width">500+</td>
                                            <td class="">1&nbsp;220</td>
                                            <td></td>
                                        </tr>
                                    </tbody>

                                </table>
                                <caption>
                                    <p class="u-t5">Alle priser er i NOK, gjelder pr. annonse og er ekskl.
                                        moms</p>
                                </caption>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid__unit col-md-4">
                    <div class="organisation-contact">
                        <div class="panel panel--info panel--kill-last-margin p-3" data-reactroot="">
                            <h4 class="u-mb0" style="font-size:18px">Trenger du hjelp?</h4><a href="#" target="_blank"
                                class="u-t5">Ofte stilte spørsmål om
                                bedriftssenteret</a><br><a href="#" target="_blank" rel="noopener noreferrer"
                                class="link u-t5">Spørsmål om faktura og
                                betaling</a>
                            <div class="media u-pt8">
                                <div class="media__img m-2"><svg width="64" height="64" viewBox="0 0 85 85"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g fill="none" fill-rule="evenodd">
                                            <circle fill="#CCFFEC" cx="42.5" cy="42.5" r="42.5"></circle>
                                            <path
                                                d="M45.64 58.571c-14.33-1.685-21.237 8.616-22.802 21.61 12.4 6.684 28.99 6.399 40.863-.993-.774-9.966-4.738-19.05-18.062-20.617z"
                                                fill="#06BEFB"></path>
                                            <path
                                                d="M33.794 59.615l.026-.009s.14.681.354 1.836c.18.257.243.645.213 1.172.682 3.807 1.77 10.563 2.061 16.327.103 2.02.192 3.944.264 5.665A41.225 41.225 0 0 1 24.6 81.06l-.115-.053c-3.884-1.82-7.203-4.165-8.678-5.45 2.4-5.51 7.415-10.686 13.88-13.423 2.12-1.797 3.871-2.437 4.107-2.518l.026-.009zm17.233-.134S61.12 62.443 64.29 75.547c.218.9.416 2.168.497 3.13-3.536 2.266-7.56 3.814-9.797 4.436a204 204 0 0 0-.355-5.612c-.838-10.636-3.608-18.02-3.608-18.02z"
                                                fill="#B6F0FF"></path>
                                            <path
                                                d="M33.789 59.201s-1.97.5-3.91 1.47a18.503 18.503 0 0 0-3.427 2.237s3.079 5.714 5.553 12.437c.969 2.631 2.013 5.99 2.882 8.969.709.13 1.213.208 1.88.306-.116-3.056-.283-6.667-.539-9.807-.625-7.665-2.439-15.612-2.439-15.612zm16.831-.438s2.17.327 4.16 1.189a23.214 23.214 0 0 1 3.63 1.972s.595 4.628-.125 12.45c-.223 2.421-.7 5.354-1.221 8.057-.79.282-1.544.552-2.256.76-.151-2.829-.379-6.02-.692-8.88-.897-8.177-3.496-15.548-3.496-15.548z"
                                                fill="#7CDFFF"></path>
                                            <path
                                                d="M33.356 51.822c.436 2.243 1.38 8.29 2.44 10.27.635 1.19 3.813 3.398 5.656 4.347 1.839.947 4.379 2.021 4.379 2.021s1.556-1.934 2.63-4.333c1.254-2.802 1.493-5.616 1.282-8.794-.203-3.088-8.15-7.178-10.882-7.01-2.731.168-5.895 1.492-5.505 3.499"
                                                fill="#F0D9B4"></path>
                                            <path
                                                d="M33.356 51.822c.137.706.325 1.789.55 3.002l.021.11s3.675 4.526 8.391 5.15c6.772.9 7.415-1.052 7.415-1.052l.008-.147a27.68 27.68 0 0 0 .002-3.552c-.203-3.088-8.15-7.178-10.882-7.01-2.731.168-5.895 1.492-5.505 3.499"
                                                fill="#DDC59E"></path>
                                            <g>
                                                <path
                                                    d="M61.016 42.425s2.678.404 4.671 2.067c1.614 1.343 2.78 3.314 3.108 3.904a2.31 2.31 0 1 1-1.15.505c-.348-.688-1.278-2.309-2.779-3.43-2.205-1.644-4.112-1.892-4.112-1.892l.262-1.154z"
                                                    fill="#474445"></path>
                                                <path
                                                    d="M13.424 19.323C8.622 23.87 7.606 30.867 9.198 37.126c1.756 6.897 6.157 9.503 5.932 15.012-.165 4.026-3.103 5.795-3.103 5.795s9.455-1.105 14.715-6.463c5.774-5.879 10.12-20.23 6.508-28.238-3.254-7.22-13.246-10.146-19.826-3.91"
                                                    fill="#B2986C"></path>
                                                <path
                                                    d="M62.433 34.692c-.052 11.53-5.319 20.784-7.698 22.534-2.308 1.698-17.425-.28-21.274-3.848-4.205-3.9-8.854-14.19-9.378-22.115-.753-11.371 5.836-20.177 15.466-20.575 16.533-.681 22.943 10.775 22.884 24.004"
                                                    fill="#F0D9B4"></path>
                                                <path
                                                    d="M41.438 32.837a3.043 3.043 0 1 1 .002 6.087 3.043 3.043 0 0 1-.002-6.087zm14.76-.53a3.045 3.045 0 0 1 0 6.09 3.044 3.044 0 0 1 0-6.09z"
                                                    fill="#767676"></path>
                                                <path
                                                    d="M33.145 30.528s-.232 5.098-2.275 8.85c-2.38 4.374-5.388 6.37-5.388 6.37s-5.564-7.767-4.234-17.88c.995-7.574 7.817-16.568 18.3-17.258 12.362-.814 18.949 5.88 21.712 11.75 1.657 3.514 2.064 6.717 2.064 6.717l-9.918.366s-.484-2.647-1.54-5.388c-.945-2.449-2.974-4.55-2.974-4.55s.56 2.135.84 5.11c.262 2.795.139 4.969.139 4.969l-16.726.944z"
                                                    fill="#C9AC82"></path>
                                                <path
                                                    d="M29.192 16.426c4.654-5.459 11-6.735 16.13-6.367 5.045.36 6.788 2.799 6.788 2.799s-11.879-3.271-19.07 5.739c-4.458 5.585-4.818 11.563-4.812 13.435 2.43.986 4.339 3.457 4.752 6.553.582 4.358-2.018 8.298-5.808 8.805-3.79.505-7.332-2.614-7.912-6.972-.52-3.88 1.485-7.43 4.606-8.52-.071-2.262.16-9.41 5.326-15.472z"
                                                    fill="#474445"></path>
                                                <path
                                                    d="M56.194 45.322s-1.936-.815-5.44-.444c-5.521.583-9.937.213-9.937.213s2.59 6.549 9.007 6.547c5.102 0 6.37-6.316 6.37-6.316"
                                                    fill="#905F5A"></path>
                                                <path
                                                    d="M43.508 47.382s3.063-.4 5.193.159c2.48.65 2.84 2.54 2.84 2.54s-1.951 1.196-4.666-.024c-2.179-.978-3.367-2.675-3.367-2.675"
                                                    fill="#FF9292"></path>
                                            </g>
                                        </g>
                                    </svg></div>
                                <div class="media__body mt-2">
                                    <h4 class="u-mb0" style="font-size:18px">Kundeservice</h4><a
                                        href="mailto:bedrift@norgshandle.no"
                                        class="link">bedrift@norgshandle.no</a><br>09 88 33 22<br>Mandag - fredag: 9 -
                                    16
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function (e) {
            $('.triger-btn1').click(function (e) {
                e.preventDefault();
                $(this).find("i").toggleClass("fa-chevron-up fa-chevron-down");
                $('#multiCollapseExample1').toggle();

            });
            $('.triger-btn2').click(function (e) {
                e.preventDefault();
                $(this).find("i").toggleClass("fa-chevron-up fa-chevron-down");
                $('#multiCollapseExample2').toggle();

            });
        });

    </script>
    ​
    @endsection
