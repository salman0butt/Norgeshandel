@extends('layouts.landingSite')

@section('page_content')
<style>
.hero {
-webkit-font-smoothing: antialiased;
font: 14px/1.5 Norgeshandeltype,HelveticaTweaked,Arial,Helvetica,sans-serif;
color: #474445;
box-sizing: border-box;
display: block;
background-image: url(https://images.pexels.com/photos/34577/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940);
background-position:center center;
background-size: cover;
height: 300px;
padding: 0 20px;
text-align: center;
width: 100%;
margin-bottom: 60px;
}
.search input[type=search] {
    -webkit-font-smoothing: antialiased;
font: inherit;
margin: 0;
line-height: normal;
font-size: 14px;
font-weight: 300;
max-width: 100%;
outline: none;
transition: border .12s ease-in-out;
border-radius: 30px;
box-sizing: border-box;
color: #999;
height: 40px;
padding-left: 40px;
padding-right: 20px;
-webkit-appearance: none;
width: 100%;
border: 1px solid #fff;
width:548px;
display:block;
margin:0 auto;
position:relative;
top:100px;
}
.relative {
    position:relative;
}
.fa-search {
    position: absolute;
    bottom: -230%;
    right: 32%;
    z-index: 999;
    color: gray;
    font-size: 20px;
}
section#announcements {
    -webkit-font-smoothing: antialiased;
font: 14px/1.5 Finntype,HelveticaTweaked,Arial,Helvetica,sans-serif;
color: #474445;
box-sizing: border-box;
display: block;
margin-bottom: 1em;
}
section#announcements li {
    border: 2px solid #28cd94;
    background-color: #e6fef7;
    margin-bottom: 2em;
    padding: 15px;
    padding-left: 80px;
}

* {
    box-sizing: border-box;
}
ul li {
    list-style: none;
}
.knowledge-base li {
    width:33%;
    padding:20px 35px;

    float:left;
}
.knowledge-base li a h4{
    font-size:16px;
}
.blocks-item-title {
    text-align:center;
}
svg {
    display:block;
    margin: 0 auto;
}
.blocks-list.plain .blocks-item {
    -webkit-font-smoothing: antialiased;
font: 14px/1.5 Finntype,HelveticaTweaked,Arial,Helvetica,sans-serif;
list-style: none;
box-sizing: border-box;
display: flex;
flex: 1 0 340px;
flex-direction: column;
justify-content: center;
max-width: 100%;
margin: 0 15px 30px;
flex-basis: 330px;
border-radius: 0;
border: 1px solid #e8eff4;
text-align: left;
transition: all .3s ease;
padding: 0;
color: inherit;
}
.blocks-list li{
    display:block;
 width:30%;
 float:left;

}
.blocks-list li a h3{
font-size:20px;
 padding:15px;
}
</style>


<main role="main">
    <div id="zen-home" class="zen_tmpl">

        <section class="section hero">
            <div class="hero-inner">
                <form role="search" class="search search-full" data-search="" data-instant="true" autocomplete="off"
                    action="#" accept-charset="UTF-8" method="get">
                    <div class="form-group relative">
                    <i class="fas fa-search"></i>
                    <input type="search" name="query" id="query"
                        placeholder="Hva kan vi hjelpe deg med? Søk her" autocomplete="off"
                        aria-label="Hva kan vi hjelpe deg med? Søk her">
                        </div>
                    </form>
            </div>
        </section>


        <div class="dme-container">
            {{-- <section id="announcements" style="">
                <ul>
                    <li>
                        <h3 class="title" style="font-size:20px;">Svindelforsøk med norgeshandel/ SPID Sikker betaling. Betaling gjennom norgeshandel</h3>
                        <div class="body">
                            <p>Har noen bedt deg om å betale/ få betalt gjennom norgeshandel eller Schibsteds betalingsløsning?
                                Det er et forsøk på svindel. Vi har IKKE en betalingsløsning. Les mer her:&nbsp;<a
                                    style="background-color: #ffffff;"
                                    href="#"
                                    target="_self">Svindelforsøk</a></p>
                            <section class="article-info">
                                <div class="article-content">
                                    <div class="article-attachments"></div>
                                </div>
                            </section>
                    
                        </div>
                    </li>
                </ul>
            </section> --}}


            <section class="section knowledge-base mb-5">
                <section class="categories blocks">
                    <ul class="blocks-list">

                        <li id="cat-201612849" class="blocks-item">
                            <a href="#" class="blocks-item-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" style="&#10;    /* color: red; */&#10;"><g xmlns="http://www.w3.org/2000/svg" fill="#ac304a"><path d="M62.67 6H22.312C18.265 6 16 8.678 16 12.346v56.48C16 71.096 17.625 73 20.426 73h39.032c2.16 0 3.522-1.28 3.522-3.278v-3.74c1.354-.06 2.02-.884 2.02-2.268V8.312C65 6.788 64.205 6 62.67 6zM32.227 26.88c0-3.64 3.368-6.157 8.17-6.157 3.098 0 5.342.657 7.782 2.362.658.426.694 1.045.233 1.627l-.348.464c-.425.58-1.007.66-1.666.233-2.285-1.55-3.836-1.937-6.004-1.937-3.02 0-4.998 1.43-4.998 3.33 0 1.898 2.017 2.4 6.005 3.29 5.578 1.203 8.48 2.673 8.48 6.313 0 2.402-1.433 3.95-3.757 4.84 1.82.93 2.593 2.208 2.593 4.26 0 3.64-3.365 6.157-8.17 6.157-3.096 0-5.34-.658-7.78-2.362-.66-.424-.7-1.043-.233-1.625l.35-.467c.462-.617 1.002-.656 1.66-.19 2.288 1.548 3.84 1.895 6.005 1.895 3.022 0 4.997-1.394 4.997-3.29 0-1.937-2.017-2.402-6.007-3.292-5.575-1.2-8.477-2.71-8.477-6.35 0-2.4 1.43-3.912 3.756-4.84-1.822-.93-2.595-2.208-2.595-4.26zm27.78 41.888c0 .81-.392 1.232-1.43 1.232H21c-1.205 0-2.063-.74-2.063-2 0-1.196.782-2 2.063-2h39c0 .912.008 2.357.008 2.768z"/><path d="M40.938 39.697c.465.076.89.194 1.278.27 2.478-.425 4.414-1.51 4.414-3.406 0-2.4-3.057-3.06-6.622-3.795l-1.396-.35c-2.4.467-4.296 1.51-4.296 3.41 0 2.44 3.06 3.098 6.622 3.872z"/></g></svg>
                                <h4 class="blocks-item-title">Annonseregler</h4>

                            </a>
                        </li>

                        <li id="cat-7464" class="blocks-item">
                            <a href="#" class="blocks-item-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"><g fill="#ac304a"><path d="M66.062 14.02H36.19c.297 1.22.47 2.654.47 3.964 0 1.367-.188 2.75-.512 4.016H60.01v35H24.97V33.41c-1.282.33-2.585.524-3.97.524-1.3 0-2.75-.172-3.963-.463v36.594a1.92 1.92 0 0 0 1.92 1.922h47.105c1.062 0 1.923-.86 1.923-1.922V15.94c0-1.06-.86-1.92-1.923-1.92z"/><path d="M20.99 5.197c-7.077 0-12.815 5.74-12.815 12.818 0 2.823.923 5.423 2.468 7.54l-6.796 6.797 2.81 2.807 6.795-6.797a12.75 12.75 0 0 0 7.54 2.47c7.08 0 12.818-5.74 12.818-12.818 0-7.08-5.74-12.818-12.82-12.818zm0 21.667a8.847 8.847 0 0 1-8.847-8.85 8.848 8.848 0 0 1 8.848-8.848c4.89 0 8.85 3.962 8.85 8.85a8.847 8.847 0 0 1-8.85 8.848zm29.808 13.794l-3.15-5.558c-.75-1.29-2.555-2.09-4.044-2.09h-6.1a4.201 4.201 0 0 0-4.204 4.193v3.637a3.446 3.446 0 0 0-2.294 3.228v3.913h2.143c.052 1.444 1.23 2.604 2.685 2.604s2.637-1.16 2.686-2.603h7.835c.05 1.444 1.23 2.604 2.684 2.604s2.63-1.16 2.683-2.603h2.27V44.07a3.428 3.428 0 0 0-3.195-3.41zm-13.864.367l-.288-3.494c0-.743.775-1.556 1.504-1.537h5.222c.74 0 1.247.387 1.62.996l2.226 4.036H36.934z"/></g></svg>
                                <h4 class="blocks-item-title">Annonsering</h4>

                            </a>
                        </li>

                        <li id="cat-201405865" class="blocks-item">
                            <a href="#" class="blocks-item-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"><path fill="#ac304a" d="M57.325 32H55v-7.477c-.018-8.292-6.723-15.01-15.014-15.01-8.298 0-14.97 6.718-14.986 15.01V32h-2.36C19.53 32 17 34.535 17 37.646v26.69C17 67.446 19.53 70 22.64 70h34.686C60.438 70 63 67.447 63 64.336v-26.69C63 34.535 60.438 32 57.325 32zM30 24.56s.008-.082.008-.123c0-5.486 4.49-9.934 9.98-9.934 5.48 0 10.025 4.448 10.025 9.934 0 .04.008.124.008.124L50 32H30v-7.44zm13.02 28.076v4.618a2.688 2.688 0 0 1-2.687 2.687h-.644c-1.485 0-2.69-1.2-2.69-2.686v-4.6c-1.904-1.057-3.208-3.064-3.208-5.396a6.198 6.198 0 1 1 12.396 0c0 2.318-1.285 4.314-3.168 5.378z"/></svg>
                                <h4 class="blocks-item-title">Trygg på Norgeshandel.no</h4>

                            </a>
                        </li>

                        <li id="cat-7504" class="blocks-item">
                            <a href="#" class="blocks-item-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"><path d="M64.98 20H14.993C12.245 20 10 22.228 10 24.98V49h60V24.98c0-2.752-2.27-4.98-5.02-4.98zM28 38H16V26h12v12zM10 55v1.02c0 2.752 2.245 4.98 4.993 4.98H64.98c2.75 0 5.02-2.228 5.02-4.98V55H10z" fill="#ac304a"/></svg>
                                <h4 class="blocks-item-title">Betaling og faktura</h4>

                            </a>
                        </li>

                        <li id="cat-7484" class="blocks-item">
                            <a href="#" class="blocks-item-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"><path fill="#ac304a" d="M40.002 10.417c-16.197 0-29.32 13.238-29.32 29.565 0 16.33 13.123 29.567 29.32 29.567 16.188 0 29.315-13.237 29.315-29.568 0-16.328-13.128-29.565-29.315-29.565zm0 11.956c5.842 0 10.582 4.757 10.582 10.625s-4.74 10.63-10.582 10.63c-5.848 0-10.586-4.763-10.586-10.63 0-5.868 4.738-10.625 10.586-10.625zm0 43.36a25.337 25.337 0 0 1-15.156-5.005c2.7-7.864 8.465-13.312 15.156-13.312 6.688 0 12.45 5.447 15.152 13.312a25.33 25.33 0 0 1-15.152 5.004z"/></svg>
                                <h4 class="blocks-item-title">Min Konto</h4>

                            </a>
                        </li>

                        <li id="cat-7364" class="blocks-item">
                            <a href="#" class="blocks-item-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"><g fill="#ac304a"><path d="M69.862 8h-59.72C8.967 8 8 8.98 8 10.156v59.68C8 71.013 8.967 72 10.142 72h59.72C71.04 72 72 71.013 72 69.836v-59.68C72 8.98 71.04 8 69.862 8zm-33.59 54H16.745S16 61.797 16 61.203v-5.45c0-1.392 1.095-2.515 2.484-2.515A2.515 2.515 0 0 1 21 55.754V57h11v-1.246c0-1.393 1.115-2.516 2.505-2.516s2.467 1.087 2.495 3.014v5.092s-.38.656-.73.656zM25.024 37H19c-1.588 0-2.883-1.253-2.883-2.843a2.886 2.886 0 0 1 2.884-2.88c1.364 0 2.552.967 2.825 2.3l.144.713.7-.203c.223-.062.622-.15.808-.15.854 0 1.548.69 1.548 1.547V37zm7.132 11a2.38 2.38 0 0 1 2.384 2.375v1.632a3.652 3.652 0 0 0-.476-.034c-1.763 0-3.393 1.7-3.483 3.562h-8.113c-.186-1.8-1.78-3.562-3.542-3.562-.162 0-.317.014-.473.034v-1.632A2.377 2.377 0 0 1 20.833 48h11.325zm5.616-21.63c-.1.24-.334.4-.596.4h-3.16v9.6c0 .356-.285.63-.64.63h-6.88v-1.515a3.023 3.023 0 0 0-3.02-3.02c-.14 0-.294.015-.45.04a4.376 4.376 0 0 0-4.028-2.7V26.77h-2.873a.65.65 0 0 1-.59-.396.643.643 0 0 1 .134-.7l10.395-10.5a.64.64 0 0 1 .907-.006L31 19.106V17.64c0-.357.268-.64.625-.64h1.737c.354 0 .638.283.638.64v4.46l3.63 3.57c.182.18.24.457.143.7zM63 60.54c0 .81-.633 1.46-1.448 1.46H46.455C45.64 62 45 61.35 45 60.538v-6.496c2.35 2.238 5.504 3.618 9.005 3.618 3.505 0 6.647-1.38 8.995-3.618v6.496zm0-8.302c-2.218 2.48-5.406 4.047-8.995 4.047-3.59 0-6.78-1.567-9.005-4.047v-.77c0-.814.64-1.466 1.455-1.466H50v-1.39c0-.893.714-1.61 1.61-1.61h4.764c.897 0 1.626.717 1.626 1.61V50h3.552c.815 0 1.448.652 1.448 1.468v.768zM64.007 35h-2.15c-.047 1.367-1.164 2.477-2.54 2.477-1.377 0-2.493-1.11-2.54-2.477H50.11c-.045 1.367-1.164 2.477-2.542 2.477-1.38 0-2.493-1.11-2.544-2.477H43v-3.692c0-1.38.893-2.604 2.17-3.054V24.94c0-2.188 1.783-3.94 3.98-3.94h5.413c1.41 0 2.727.73 3.44 1.95l2.98 5.13A3.241 3.241 0 0 1 64 31.31l.007 3.69z"/><path d="M48.62 28l-.277-3.5c0-.714.747-1.517 1.446-1.5h4.44c.712 0 1.2.395 1.56.98L57.932 28H48.62zm2.864 21.982v-1.295c0-.086.07-.157.152-.157h4.726c.083 0 .153.07.153.157v1.295h-5.03z"/></g></svg>
                                <h4 class="blocks-item-title">Markedsplassene</h4>

                            </a>
                        </li>
                    </ul>

                </section>
<div style="clear:both;"></div>

            </section>

            <section id="ext-links" class="mb-5">
                <ul class="blocks-list plain">
                    <li id="el-telefon" class="blocks-item">
                   
                        <a href="#">
                        <svg style="margin:0px;float:left" xmlns="http://www.w3.org/2000/svg" width="50" height="50"><path fill="#A6A4A5" d="M41.73 33.75c0-.44-.33-1.14-.56-1.35-1.12-1.01-3.19-1.43-5.41-2.67s-2.41-.85-2.81-.65c-.39.2-2.08 2.83-2.89 3.68-.52.54-1.26.46-1.54.37-6.37-2.07-11.48-10.11-11.48-10.11-.59-.59 0-1.24 0-1.24 1.13-1.15 1.63-1.68 2.28-2.55 1.17-1.57-2.22-7.37-2.67-8.61-.46-1.24-2.94-.78-2.94-.78-4.85.74-6.02 7.15-4.96 9.65 6.5 15.3 21.89 25.4 30.51 19.18 0 .01 2.47-1.32 2.47-4.92z"/></svg>
                            <h3>Kontakt oss</h3>
                        </a>
                    </li>

                    <li id="el-om-Norgeshandel" class="blocks-item">
                        <a href="#">
                        <svg style="margin:0px;float:left" xmlns="http://www.w3.org/2000/svg" width="50" height="50"><path fill="#A6A4A5" d="M24.99 9.22C14.07 9.22 5.22 16.28 5.22 25c0 8.71 8.85 15.78 19.77 15.78S44.77 33.72 44.77 25c0-8.72-8.86-15.78-19.78-15.78zM9 26.85c-1.02 0-1.85-.83-1.85-1.85s.83-1.85 1.85-1.85 1.85.83 1.85 1.85-.83 1.85-1.85 1.85zm24.47-.58l-8.01 8c-.12.12-.29.19-.45.19-.16 0-.33-.06-.45-.19 0 0-6.84-6.83-8.12-8.12-1.29-1.29-1.57-2.95-1.57-3.87 0-3.06 2.49-5.55 5.55-5.55 1.86 0 3.58.95 4.6 2.45a5.59 5.59 0 0 1 4.6-2.45c3.06 0 5.55 2.49 5.55 5.55a5.527 5.527 0 0 1-1.7 3.99zm7.52.58c-1.02 0-1.85-.83-1.85-1.85s.83-1.85 1.85-1.85 1.85.83 1.85 1.85-.83 1.85-1.85 1.85z"/></svg>
                            <h3>Om Norgeshandel.no</h3>
                        </a>
                    </li>

                    <li id="el-Norgeshandel-shopping-bis" class="blocks-item">
                        <a href="#">
                        <svg style="margin:0px;float:left" xmlns="http://www.w3.org/2000/svg" width="50" height="50"><path fill="#A6A4A5" d="M44.75 14.42a.981.981 0 0 0-.78-.42h-31l-1.65-4.32c-.14-.39-.5-.68-.9-.68H4.38c-.53 0-.96.46-.96.99S3.85 11 4.38 11h5.36l8.41 23.53A4.071 4.071 0 0 0 16.18 38c0 2.18 1.65 3.87 3.82 3.87s3.88-1.7 3.88-3.87c0-.74-.18-1.4-.54-2h8.28c-.36.6-.54 1.26-.54 2 0 2.18 1.77 3.87 3.95 3.87s3.91-1.7 3.91-3.87-1.75-4-3.92-4H20l-1.12-3H38.8c.41 0 .77-.27.91-.66l5.19-15.05c.08-.29.03-.61-.15-.87M22 38c0 1.16-.88 2-2 2s-2-.88-2-2 .87-2 2-2 2 .84 2 2zm13 2c-1.14 0-2-.88-2-2s.88-2 2-2 2 .89 2 2-.86 2-2 2zm3.19-11h-20l-4.55-13h28.98l-4.43 13z"/></svg>
                            <h3>Norgeshandel shopping</h3>
                        </a>
                    </li>
                </ul>
            </section>
        </div>
    </div>

</main>
    <div style="clear:both;"></div>
@endsection
