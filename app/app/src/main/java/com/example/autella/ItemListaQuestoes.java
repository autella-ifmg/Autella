package com.example.autella;

import androidx.fragment.app.FragmentActivity;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import java.util.ArrayList;

import static androidx.core.app.ActivityCompat.startActivityForResult;

public class ItemListaQuestoes extends ArrayAdapter<Questao> {
    private Context contextoPai;
    private ArrayList<Questao> questoes;

    private static class ViewHolder {
        private TextView alternativaCorreta;
    }

    public ItemListaQuestoes(Context contexto, ArrayList<Questao> questoes) {
        super(contexto, R.layout.item_lista_questoes, questoes);
        this.contextoPai = contexto;
        this.questoes = questoes;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        //return super.getView(position, convertView, parent);
        Questao questaoAtual = this.questoes.get(position);
        ViewHolder novaView;
        final View resultado;

        if (convertView == null) {
            //View sendo criada pela primeira vez.
            novaView = new ViewHolder();
            LayoutInflater inflater = LayoutInflater.from(getContext());
            convertView = inflater.inflate(R.layout.item_lista_questoes, parent, false);

            novaView.alternativaCorreta = (TextView) convertView.findViewById(R.id.alternativaCorretaItemListaQuestoes);

            resultado = convertView;
            convertView.setTag(novaView);
        } else {
            novaView = (ViewHolder) convertView.getTag();
            resultado = convertView;
        }

        //Setar os valores dos campos.
        novaView.alternativaCorreta.setText("Questão " + (position + 1) + ": " + questaoAtual.getAlternativaCorreta());
        return resultado;
    }
}