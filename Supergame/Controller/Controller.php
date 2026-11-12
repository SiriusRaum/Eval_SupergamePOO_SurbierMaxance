<?php
require_once __DIR__ . '/../Model/Model.php';
require_once __DIR__ . '/../View/View.php';
class Controller {
    private Model $model;
    private View $view;
// mise en place du constructeur
    public function __construct(Model $model, View $view) {
        $this->model = $model;
        $this->view = $view;
    }
// mise en place des getters
    public function getModel(): Model {
        return $this->model;
    }

    public function getView(): View {
        return $this->view;
    }
//mise en place des setters
    public function setModel(Model $newModel): self {
        $this->model = $newModel;
        return $this;
    }

    public function setView(View $newView): self {
        $this->view = $newView;
        return $this;
    }
// mise en place du render

    public function render(): void {
        $this->view->displayAll();
    }
}