<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerZiPTKv1\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerZiPTKv1/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerZiPTKv1.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerZiPTKv1\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerZiPTKv1\App_KernelDevDebugContainer([
    'container.build_hash' => 'ZiPTKv1',
    'container.build_id' => '981c250e',
    'container.build_time' => 1583693175,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerZiPTKv1');
