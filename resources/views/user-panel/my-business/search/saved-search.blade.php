@extends('layouts.landingSite')

@section('page_content')

<div id="search-mysavedsearch-root">
    <main class="profile">
        <div class="dme-container">
            <div class="breade-crumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('my-business')}}">Min handel </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Endre profil</li>
                    </ol>
                </nav>
            </div>
            <!---- end breadcrumb----->
            <section class="u-r-size3of5" id="saved-search-editor">
                <h2 class="u-mt32 panel">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Square</font>
                    </font>
                </h2>
                <div class="saved-search-panel panel panel--info inputs-white p-4">
                    <div class="grid">
                        <div class="grid__unit u-size2of3">
                            <h3 class="u-t4"><a href="https://www.finn.no/user/search.html?alertId=38105410">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">'bike', Clothing, cosmetics and
                                            accessories,
                                            Torget</font>
                                    </font>
                                </a></h3>
                            <p><span class="u-truncate u-display-block">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Email, Push, On FINN.no</font>
                                    </font>
                                </span></p>
                        </div>
                        <div class="btn bg-maroon text-white pt-0 pb-0"><button class="btn bg-maroon text-white">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Change</font>
                                </font>
                            </button></div>
                    </div>
                </div>
            </section>

            <div id="search-mysavedsearch-root">
                <section class="u-r-size3of5" id="saved-search-editor">
                    <h2 class="u-mt32 panel">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Square</font>
                        </font>
                    </h2>
                    <div class="saved-search-panel panel panel--info inputs-white p-4" style="padding-bottom: 50px !important;">
                        <div class="form-grid u-mh0">
                            <div class="form-grid__unit u-ph0">
                                <form id="update-form" class="u-mb8">
                                    <h3 class="u-t4">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">'bike', Clothing, cosmetics and
                                                accessories,
                                                Torget</font>
                                        </font>
                                    </h3>
                                    <div class="input input--text"><label for="savedSearchName-38105410">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Name</font>
                                            </font>
                                        </label><input class="form-control search-control" name="savedSearchName" id="savedSearchName-38105410"
                                            value=""></div>
                                    <h4 class="u-mt16">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Notification Settings</font>
                                        </font>
                                    </h4>
                                    <div class="input-toggle"><input name="notify" type="checkbox" id="38105410-mail"
                                            value="mail" checked=""><label for="38105410-mail"
                                            class="u-display-block"><strong class="u-b1">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Daily Email Alert </font>
                                                </font>
                                            </strong><span class="u-display-block u-d1">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">New hits for this search are
                                                        sent to
                                                        your email address</font>
                                                </font>
                                            </span></label></div>
                                    <div class="input-toggle"><input name="notify" type="checkbox" id="38105410-push"
                                            value="push" checked=""><label for="38105410-push"
                                            class="u-display-block"><strong class="u-b1">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Immediate push notification
                                                    </font>
                                                </font>
                                            </strong>
                                            <font style="vertical-align: inherit;"><span class="u-display-block u-d1">
                                                    <font style="vertical-align: inherit;">Real-time </font>
                                                </span><strong class="u-b1">
                                                    <font style="vertical-align: inherit;">notification </font>
                                                </strong></font><span class="u-display-block u-d1">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">for this search is sent to
                                                        the FINN
                                                        app on iPhone, iPad and Android</font>
                                                </font>
                                            </span>
                                        </label></div>
                                    <div class="input-toggle"><input name="notify" type="checkbox" id="38105410-web"
                                            value="web" checked=""><label for="38105410-web"
                                            class="u-display-block"><strong class="u-b1">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Immediate notification on
                                                        FINN.no
                                                    </font>
                                                </font>
                                            </strong>
                                            <font style="vertical-align: inherit;"><span class="u-display-block u-d1">
                                                    <font style="vertical-align: inherit;">Real-time </font>
                                                </span><strong class="u-b1">
                                                    <font style="vertical-align: inherit;">notification </font>
                                                </strong></font><span class="u-display-block u-d1">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">in the top menu on FINN.no
                                                    </font>
                                                </font>
                                            </span>
                                        </label></div>
                                    <div class="input-toggle"><button class="btn bg-maroon text-white">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Finished</font>
                                            </font>
                                        </button></div>
                                </form>
                                <br>
                                <div class="u-display-inline" style="display: block;width: 10%;float: left;"><button class="btn bg-maroon text-white">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Cancel</font>
                                        </font>
                                    </button></div>
                                <div class="u-display-inline" style="display: block;width: 16%;float: left;"><button class="btn bg-maroon text-white">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Delete the search</font>
                                        </font>
                                    </button> </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
</div>
</main>


@endsection
