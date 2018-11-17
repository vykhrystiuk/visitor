FROM ubuntu:18.04

ARG wizbltempcoin_name="wizbltempcoin-v0.1.2.7-181113.tar.gz"

RUN apt-get update && apt-get install -y curl
RUN mkdir -p /root/lib
COPY ./lib /root/lib
COPY ./config/wizbl_tempcoincore.conf /root/.wizbl_tempcoincore/wizbl_tempcoincore.conf

WORKDIR /root
RUN tar xvzf /root/lib/$wizbltempcoin_name -C /bin

EXPOSE 18724 18624

CMD wizbltempcoind -testnet