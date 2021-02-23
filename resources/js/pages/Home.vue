<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inline Charts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
              <li class="breadcrumb-item active">Inline Charts</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
      <!-- <h5 class="mt-4 mb-2">Alerts and Callouts</h5> -->
    <div class="row" style="margin-top: 1%">
      <div class="col-md-6">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-exclamation-triangle"></i>
              Alerts
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="alert alert-danger alert-dismissible">
              <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-hidden="true"
              >
                ×
              </button>
              <h5><i class="icon fas fa-ban"></i> Alert!</h5>
              Danger alert preview. This alert is dismissable. A wonderful
              serenity has taken possession of my entire soul, like these sweet
              mornings of spring which I enjoy with my whole heart.
            </div>
            <div class="alert alert-info alert-dismissible">
              <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-hidden="true"
              >
                ×
              </button>
              <h5><i class="icon fas fa-info"></i> Alert!</h5>
              Info alert preview. This alert is dismissable.
            </div>
            <div class="alert alert-warning alert-dismissible">
              <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-hidden="true"
              >
                ×
              </button>
              <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
              Warning alert preview. This alert is dismissable.
            </div>
            <div class="alert alert-success alert-dismissible">
              <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-hidden="true"
              >
                ×
              </button>
              <h5><i class="icon fas fa-check"></i> Alert!</h5>
              Success alert preview. This alert is dismissable.
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->

      <div class="col-md-6">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-bullhorn"></i>
              Callouts
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="callout callout-danger">
              <h5>I am a danger callout!</h5>

              <p>
                There is a problem that we need to fix. A wonderful serenity has
                taken possession of my entire soul, like these sweet mornings of
                spring which I enjoy with my whole heart.
              </p>
            </div>
            <div class="callout callout-info">
              <h5>I am an info callout!</h5>

              <p>Follow the steps to continue to payment.</p>
            </div>
            <div class="callout callout-warning">
              <h5>I am a warning callout!</h5>

              <p>This is a yellow callout.</p>
            </div>
            <div class="callout callout-success">
              <h5>I am a success callout!</h5>
              <p>This is a green callout.</p>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    </div>
    </section>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>