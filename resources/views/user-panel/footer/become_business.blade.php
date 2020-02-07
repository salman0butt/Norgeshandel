@extends('layouts.landingSite')

@section('page_content')

<style>
.tick {
    padding:3px;
}
.tick svg {
    margin-right:10px;
}
.grid__unit .link--dark .media--top {
    width: 35%;
    float: left;
    margin-bottom:2%;
}
.grid__unit .link--dark .media--top:hover {
    text-decoration:underline;
}
.clear-fix {
    clear:both;
}
.u-caption {
  font-size: 14px;
  line-height: 18px;
  font-weight: 400;
}
</style>

<div class="container u-mb32" style="margin-top:5%;display:block;width:45%;">
    <div class="panel">
        <h2>
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">Bli bedriftskunde hos FINN</font>
            </font>
        </h2>
        <p class="u-mb16">
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">
                    Annonserer du jevnlig på FINN på vegne av en bedrift ? </font>
            </font><br>
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">
                    Da lønner det seg å være bedriftskunde.
                </font>
            </font>
        </p>
        <p>
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">
                    En bedriftsavtale gir deg fordeler som:
                </font>
            </font>
        </p>

        <div class="media media--top u-mt16 u-mb16 tick">
            <div class="media__img u-primary-blue">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" style="color:#AC304A;">
                    <path fill="currentColor" fill-rule="evenodd"
                        d="M9.78 15.51l8.86-10.05c.5-.57 1.37-.62 1.92-.1.55.53.59 1.41.09 1.98l-9.88 11.2c-.54.62-1.47.61-2 0l-5.42-5.8c-.5-.57-.46-1.46.1-1.97a1.32 1.32 0 0 1 1.91.1l4.42 4.64z">
                    </path>
                </svg>
            </div>
            <div class="media__body">
                <h3 class="u-strong u-t4 u-mb0">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Betaling med faktura</font>
                    </font>
                </h3>
                <p class="u-caption">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        Få bedre oversikt med samlefaktura en gang i måneden
                        </font>
                    </font>
                </p>
            </div>
        </div>
        <div class="media media--top u-mt16 u-mb16 tick">
            <div class="media__img u-primary-blue">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" style="color:#AC304A;">
                    <path fill="currentColor" fill-rule="evenodd"
                        d="M9.78 15.51l8.86-10.05c.5-.57 1.37-.62 1.92-.1.55.53.59 1.41.09 1.98l-9.88 11.2c-.54.62-1.47.61-2 0l-5.42-5.8c-.5-.57-.46-1.46.1-1.97a1.32 1.32 0 0 1 1.91.1l4.42 4.64z">
                    </path>
                </svg>
            </div>
            <div class="media__body">
                <h3 class="u-strong u-t4 u-mb0">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Firmaprofilering</font>
                    </font>
                </h3>
                <p class="u-caption">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Vis frem bedriften på Norges største markedsplass
                        </font>
                    </font>
                </p>
            </div>
        </div>
        <div class="media media--top u-mt16 u-mb16 tick">
            <div class="media__img u-primary-blue">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" style="color:#AC304A;">
                    <path fill="currentColor" fill-rule="evenodd"
                        d="M9.78 15.51l8.86-10.05c.5-.57 1.37-.62 1.92-.1.55.53.59 1.41.09 1.98l-9.88 11.2c-.54.62-1.47.61-2 0l-5.42-5.8c-.5-.57-.46-1.46.1-1.97a1.32 1.32 0 0 1 1.91.1l4.42 4.64z">
                    </path>
                </svg>
            </div>
            <div class="media__body">
                <h3 class="u-strong u-t4 u-mb0">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Lenke til bedriftens nettsider i annonsene</font>
                    </font>
                </h3>
                <p class="u-caption">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Skap økt trafikk til egne nettsider</font>
                    </font>
                </p>
            </div>
        </div>
        <div class="media media--top u-mt8 u-mb8 tick">
            <div class="media__img u-primary-blue">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" style="color:#AC304A;">
                    <path fill="currentColor" fill-rule="evenodd"
                        d="M9.78 15.51l8.86-10.05c.5-.57 1.37-.62 1.92-.1.55.53.59 1.41.09 1.98l-9.88 11.2c-.54.62-1.47.61-2 0l-5.42-5.8c-.5-.57-.46-1.46.1-1.97a1.32 1.32 0 0 1 1.91.1l4.42 4.64z">
                    </path>
                </svg>
            </div>
            <div class="media__body">
                <h3 class="u-strong u-t4 u-mb0">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Dedikert kontaktperson i Norgeshandel</font>
                    </font>
                </h3>
                <p class="u-caption">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Optimaliser annonseringen sammen med en som kjenner din bedrift

                        </font>
                    </font>
                </p>
            </div>
        </div>

        <div class="user-accounts u-mt32 u-mb32">

        </div>

        <p>
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">
                    Velg marked for å lese mer om fordelene og bli kunde:
                </font>
            </font>
        </p>

        <div class="grid">
            <div class="grid__unit">
                <a href="#" class="link link--dark">
                    <div class="media media--top u-mt8 u-mb8">
                        <div class="media__img u-secondary-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 45 35">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M33.716 15.894a.792.792 0 0 0-.795.79V30.42H30.33V19.953a.793.793 0 0 0-.795-.79H24.3a.792.792 0 0 0-.795.79V30.42H21.45v-1.824c0-1.873-1.534-3.396-3.42-3.396-.193 0-.414.027-.623.064a5.01 5.01 0 0 0-3.798-3.1v-5.481a.792.792 0 0 0-.795-.79h-.48l10.952-10.99 4.816 4.705c.228.224.57.29.866.168a.79.79 0 0 0 .49-.729V6.974h1.777v5.38c0 .21.086.414.237.562l3.042 2.978h-.798zm-8.62 14.52h3.643v-9.672h-3.643v9.672zm-5.237 0h-4.478s-1.648.007-2.638.007c-1.876 0-3.403-1.516-3.403-3.38 0-1.862 1.527-3.378 3.403-3.378 1.61 0 3.013 1.134 3.335 2.696l.172.837.827-.236c.261-.075.73-.18.953-.18 1.008 0 1.83.814 1.83 1.817v1.817zM37.013 16.12l-4.188-4.098V6.184a.792.792 0 0 0-.795-.79h-3.368a.792.792 0 0 0-.795.79v.978l-4.031-3.935a.799.799 0 0 0-1.123.008L9.863 16.128a.787.787 0 0 0-.169.86.796.796 0 0 0 .734.485h1.59v4.669c-2.41.35-4.268 2.41-4.268 4.9C7.75 29.776 9.99 32 12.743 32c.993 0 2.645-.007 2.642-.007h4.685V32h13.646a.792.792 0 0 0 .795-.79V17.473h1.944a.795.795 0 0 0 .735-.49.785.785 0 0 0-.177-.862z">
                                </path>
                            </svg>
                        </div>
                        <div class="media__body">
                            <div class="u-t3 u-mt4">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Eiendom</font>
                                </font>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="grid__unit">
                <a href="#" class="link link--dark">
                    <div class="media media--top u-mt8 u-mb8">
                        <div class="media__img u-secondary-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 45 35">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M34.625 26.896H10.374a.752.752 0 0 1-.755-.748v-9.644a20.942 20.942 0 0 0 9.752 4.115v1.683c0 .444.361.802.81.802h4.639c.447 0 .81-.358.81-.802V20.62a20.905 20.905 0 0 0 9.75-4.125v9.654c0 .413-.339.748-.755.748zM20.99 21.501h3.02v-3.302h-3.02V21.5zM10.374 10.854h24.251c.416 0 .756.335.756.748v2.802a19.285 19.285 0 0 1-9.752 4.59v-1.597a.806.806 0 0 0-.81-.802H20.18c-.448 0-.81.36-.81.802v1.6a19.343 19.343 0 0 1-9.75-4.584v-2.811c0-.413.338-.748.754-.748zm8.606-3.072a.18.18 0 0 1 .18-.178h6.68c.098 0 .179.08.179.178V9.25H18.98V7.782zM34.625 9.25h-6.987V7.782C27.638 6.8 26.832 6 25.84 6H19.16c-.992 0-1.8.8-1.8 1.782V9.25h-6.986C9.064 9.25 8 10.305 8 11.602v14.546c0 1.298 1.065 2.352 2.374 2.352h24.251c1.31 0 2.375-1.054 2.375-2.352V11.602c0-1.297-1.066-2.352-2.375-2.352z">
                                </path>
                            </svg>
                        </div>
                        <div class="media__body">
                            <div class="u-t3 u-mt4">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Jobb</font>
                                </font>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="grid__unit">
                <a href="#" class="link link--dark">
                    <div class="media media--top u-mt8 u-mb8">
                        <div class="media__img u-secondary-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 45 35">
                                <g fill="currentColor" fill-rule="evenodd">
                                    <path
                                        d="M38.834 25.624h-2.221c-.596-1.629-2.139-2.8-3.96-2.8-1.823 0-3.365 1.171-3.961 2.8H16.829c-.596-1.629-2.138-2.8-3.96-2.8-1.823 0-3.365 1.171-3.961 2.8H6.885v-4.581a3.805 3.805 0 0 1 2.972-3.702l.632-.137v-6.8c0-2.767 2.241-5.02 4.997-5.02h9.278c1.773 0 3.429.96 4.32 2.503l5.407 9.365h.568c2.082 0 3.775 1.701 3.775 3.79v4.582zm-6.181 4.114a2.645 2.645 0 0 1-2.634-2.652 2.646 2.646 0 0 1 2.634-2.652c1.452 0 2.632 1.19 2.632 2.652a2.645 2.645 0 0 1-2.632 2.652zm-19.784 0a2.645 2.645 0 0 1-2.634-2.652 2.646 2.646 0 0 1 2.634-2.652 2.646 2.646 0 0 1 2.633 2.652 2.645 2.645 0 0 1-2.633 2.652zm27.565-8.695c0-2.857-2.218-5.203-5.016-5.39l-4.95-8.575a6.61 6.61 0 0 0-5.704-3.305h-9.278c-3.638 0-6.597 2.975-6.597 6.632v5.54a5.432 5.432 0 0 0-3.604 5.098v6.192H8.65c.08 2.28 1.935 4.114 4.219 4.114 2.284 0 4.138-1.833 4.218-4.114h11.347c.08 2.28 1.935 4.114 4.219 4.114 2.283 0 4.138-1.833 4.218-4.114h3.563v-6.192z">
                                    </path>
                                    <path
                                        d="M15.25 15.563l-.313-4.62c0-1.007.819-1.828 1.824-1.828h5.347l.002.024 1.746-.01a1.816 1.816 0 0 1 1.577.894l3.149 5.52-13.333.02zm8.595-8.046l-7.084-.013c-1.888 0-3.424 1.542-3.422 3.493l.415 6.179 17.59-.026-4.528-7.937c-.618-1.054-1.744-1.725-2.97-1.696z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="media__body">
                            <div class="u-t3 u-mt4">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Motor</font>
                                </font>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="grid__unit">
                <a href="#" class="link link--dark">
                    <div class="media media--top u-mt8 u-mb8">
                        <div class="media__img u-secondary-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 45 35">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M41.969 13.522L28.142 17.27l.754-2.28a.807.807 0 0 0-.502-1.018.796.796 0 0 0-1.008.507l-3.794 11.465a3.532 3.532 0 0 1-2.43 2.313l-3.229.875 1.398-12.208a.803.803 0 0 0-.699-.892.794.794 0 0 0-.882.706l-.395 3.453-7.494 1.99L2.683 11.56l.605-.119a4.407 4.407 0 0 1 4.186 1.045l2.174 2.031L33.257 8.12a6.93 6.93 0 0 1 3.693.018l1.48.416-3.405.923a.805.805 0 0 0-.563.986.797.797 0 0 0 .975.569l6.011-1.63.296.083c.777.22 1.389.845 1.598 1.632a1.97 1.97 0 0 1-1.373 2.406zM13.356 6.608l3.229-.875a3.495 3.495 0 0 1 3.247.773l3.076 2.751-6.343 1.72-3.21-4.37zm31.523 4.091a3.921 3.921 0 0 0-2.708-2.765l-.23-.065a.77.77 0 0 0-.403-.113l-4.161-1.17a8.485 8.485 0 0 0-4.533-.022l-8.093 2.193L20.887 5.3a5.06 5.06 0 0 0-4.715-1.122l-5.49 1.488 4.228 5.758-4.826 1.31-1.53-1.43c-1.536-1.435-3.658-1.965-5.622-1.43L0 10.44l9.18 13.586 7.978-2.12-1.076 9.393 5.492-1.489a5.13 5.13 0 0 0 3.528-3.357l2.434-7.354 14.845-4.022c1.882-.51 3.003-2.476 2.498-4.379z">
                                </path>
                            </svg>
                        </div>
                        <div class="media__body">
                            <div class="u-t3 u-mt4">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Reise</font>
                                </font>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="grid__unit">
                <a href="#" class="link link--dark">
                    <div class="media media--top u-mt8 u-mb8">
                        <div class="media__img u-secondary-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 45 35">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M36.935 25.305h-2.11v1.856H31.65v-1.856h-18.3v1.856h-3.176v-1.856h-2.11V17.35c0-1.766 1.416-3.204 3.156-3.204 1.74 0 3.155 1.438 3.155 3.204v.795h16.25v-.795c0-1.766 1.415-3.204 3.155-3.204 1.74 0 3.155 1.438 3.155 3.204v7.956zM10.59 11.043c0-1.767 1.415-3.204 3.155-3.204h17.51c1.74 0 3.154 1.437 3.154 3.204v1.56a4.69 4.69 0 0 0-.629-.047c-2.336 0-4.281 1.733-4.655 3.999h-13.25c-.374-2.266-2.32-3.999-4.655-3.999-.215 0-.424.02-.63.048v-1.56zm25.384 2.066v-2.066c0-2.643-2.117-4.793-4.72-4.793h-17.51c-2.602 0-4.719 2.15-4.719 4.793v2.066A4.807 4.807 0 0 0 6.5 17.35v9.546h2.11v1.855h6.305v-1.855h15.17v1.855h6.305v-1.855h2.11v-9.546a4.806 4.806 0 0 0-2.526-4.24z">
                                </path>
                            </svg>
                        </div>
                        <div class="media__body">
                            <div class="u-t3 u-mt4">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Torget</font>
                                </font>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="clear-fix"></div>
            </div>
        </div>
    </div>
</div>


@endsection
