protoc --proto_path=. --php_out=. ./application.proto &&\
rm -rf ../app/Proto &&\
mkdir -p ../app/Proto &&\
mv App/Proto/GPBMetadata ../app/Proto &&\
mv App/Proto/* ../app/Proto
