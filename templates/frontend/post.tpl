{extends file='../base.tpl'}

{block name=body}
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1>{$post.title}</h1>
                <p>
                    <small>
                        {$post.author}
                        | {$post.created_at|date_format:"%Y-%m-%d %H:%M:%S"}
                        | {$post.updated_at|date_format:"%Y-%m-%d %H:%M:%S"}
                    </small>
                </p>
                {$post.content}
            </div>
        </div>
    </div>
{/block}