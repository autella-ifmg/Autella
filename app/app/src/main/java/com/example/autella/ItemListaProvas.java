package com.example.autella;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import java.util.ArrayList;

public class ItemListaProvas extends ArrayAdapter<Prova> {
    private Context contextoPai;
    private ArrayList<Prova> provas;

    private static class ViewHolder{
        private TextView nomeItemListaProvas;
        private TextView idItemListaProvas;
    }

    public ItemListaProvas(Context contexto, ArrayList<Prova> provas){
        super(contexto, R.layout.item_lista_provas, provas);
        this.contextoPai = contexto;
        this.provas = provas;
    }
    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        //return super.getView(position, convertView, parent);
        Prova provaAtual = this.provas.get(position);
        ViewHolder novaView;
        final View resultado;

        if(convertView == null){
             // View sendo criada pela primeira vez
            novaView = new ViewHolder();
            LayoutInflater inflater = LayoutInflater.from(getContext());
            convertView = inflater.inflate(R.layout.item_lista_provas, parent, false);

            novaView.nomeItemListaProvas = (TextView) convertView.findViewById(R.id.nomeItemListaProvas);
            novaView.idItemListaProvas = (TextView) convertView.findViewById(R.id.idItemListaProvas);

            resultado = convertView;
            convertView.setTag(novaView);
        } else {
            novaView = (ViewHolder) convertView.getTag();
            resultado = convertView;
        }

        // Setar os valores dos campos
        novaView.nomeItemListaProvas.setText(provaAtual.getNome());
        novaView.idItemListaProvas.setText(String.valueOf(provaAtual.getId()));

        return resultado;
    }
}


















