{extends file='../base.tpl'}

{block name=body}
    <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Blog admin</a>

        <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
                    keresés
                </button>
            </li>
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    lista
                </button>
            </li>
        </ul>

        <div id="navbarSearch" class="navbar-search w-100 collapse">
            <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
                <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">Blog admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="/admin?page=users">
                                    <i class="bi bi-peoples"></i>
                                    Felhasználók
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="/admin?page=posts">
                                    <i class="bi bi-list"></i>
                                    Bejegyzések
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Vezérlőpult</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                            <svg class="bi"><use xlink:href="#calendar3"/></svg>
                            This week
                        </button>
                    </div>
                </div>

                <h2>{$title}</h2>
                <div class="table-responsive small">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Cím</th>
                                <th scope="col">Szerző</th>
                                <th scope="col">Készítve</th>
                                <th scope="col">Módosítva</th>
                                <th scope="col">Eszközök</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                {foreach $posts as $post}
                                    <td>{$smarty.foreach.posts.index + 1}</td>
                                    <td>{$post.title}</td>
                                    <td>{$post.author}</td>
                                    <td>{$post.created_at|date_format:"%Y-%m-%d %H:%M:%S"}</td>
                                    <td>{$post.updated_at|date_format:"%Y-%m-%d %H:%M:%S"}</td>
                                    <td>
                                        <a class="btn btn-primary" href="/admin?edit={$post.id}">
                                            <i class="bi bi-pen"></i> Szerkesztés
                                        </a>
                                        <a class="btn btn-secondary" href="/admin?delete={$post.id}">
                                            <i class="bi bi-delete"></i> Törlés
                                        </a>
                                    </td>
                                {/foreach}
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
{/block}