{extends file='../../base.tpl'}

{block name=body}
<!-- include header.tpl -->
{include file='header.tpl'}

<div class="container-fluid">
    <div class="row">

        {include file='sidebar.tpl'}

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">{$title}</h1>
            </div>

            <form action="?action=create&type=user&id={$user.id}" method="post">
                <input type="hidden" name="id" value="">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail cím</label>
                    <input type="text" class="form-control" id="email" name="email" value="">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Jelszó</label>
                    <input type="password" class="form-control" id="password" name="password" value="">
                </div>
                <div class="mb-3">
                    <label for="is_active" class="form-label">Státusz</label>
                    <select class="form-select" id="is_active" name="is_active" required>
                        <option value="1">Aktív</option>
                        <option value="0">Inaktív</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Mentés</button>
            </form>
        </main>
    </div>
</div>

{/block}