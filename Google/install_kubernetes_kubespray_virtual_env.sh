git clone --depth=1 https://github.com/kubernetes-sigs/kubespray.git

KUBESPRAYDIR=$(pwd)/kubespray
VENVDIR="$KUBESPRAYDIR/.venv"
ANSIBLE_VERSION=2.12

virtualenv  --python=$(which python3) $VENVDIR

source $VENVDIR/bin/activate
cd $KUBESPRAYDIR

pip install -U -r requirements-$ANSIBLE_VERSION.txt