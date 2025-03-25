{extends file='../base.tpl'}

{block name=body}
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Bejelentkezés</h1>
                <form action="?action=login" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail cím</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Jelszó</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Bejelentkezés</button>
                </form>
            </div>
        </div>
    </div>
{/block}
